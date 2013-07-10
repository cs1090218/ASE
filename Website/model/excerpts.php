<?php

//
// $Id: test.php 2903 2011-08-04 13:30:49Z shodan $
//

require ( "sphinxapi.php" );

//////////////////////
// parse command line
//////////////////////

// for very old PHP versions, like at my home test server
if ( is_array($argv) && !isset($_SERVER["argv"]) )
	$_SERVER["argv"] = $argv;
unset ( $_SERVER["argv"][0] );

// build query
if ( !is_array($_SERVER["argv"]) || empty($_SERVER["argv"]) )
{
	print ( "Usage: php -f test.php [OPTIONS] query words\n\n" );
	print ( "Options are:\n" );
	print ( "-h, --host <HOST>\tconnect to searchd at host HOST\n" );
	print ( "-p, --port\t\tconnect to searchd at port PORT\n" );
	print ( "-i, --index <IDX>\tsearch through index(es) specified by IDX\n" );
	print ( "-s, --sortby <CLAUSE>\tsort matches by 'CLAUSE' in sort_extended mode\n" );
	print ( "-S, --sortexpr <EXPR>\tsort matches by 'EXPR' DESC in sort_expr mode\n" );
	print ( "-n, --any\t\tuse 'match any word' matching mode\n" );
	print ( "-b, --boolean\t\tuse 'boolean query' matching mode\n" );
	print ( "-e, --extended\t\tuse 'extended query' matching mode\n" );
	print ( "-ph,--phrase\t\tuse 'exact phrase' matching mode\n" );
	print ( "-f, --filter <ATTR>\tfilter by attribute 'ATTR' (default is 'group_id')\n" );
	print ( "-fr,--filterrange <ATTR> <MIN> <MAX>\n\t\t\tadd specified range filter\n" );
	print ( "-v, --value <VAL>\tadd VAL to allowed 'group_id' values list\n" );
	print ( "-g, --groupby <EXPR>\tgroup matches by 'EXPR'\n" );
	print ( "-gs,--groupsort <EXPR>\tsort groups by 'EXPR'\n" );
	print ( "-d, --distinct <ATTR>\tcount distinct values of 'ATTR''\n" );
	print ( "-l, --limit <COUNT>\tretrieve COUNT matches (default: 20)\n" );
	print ( "--select <EXPRLIST>\tuse 'EXPRLIST' as select-list (default: *)\n" );
	exit;
}

$args = array();
foreach ( $_SERVER["argv"] as $arg )
	$args[] = $arg;

$cl = new SphinxClient ();

$q = "";
$sql = "";
$mode = SPH_MATCH_ANY;
$host = "localhost";
$port = 9312;
$index = 'test1';
$groupby = "";
$groupsort = "@group desc";
$filter = "group_id";
$filtervals = array();
$distinct = "";
$sortby = "";
$sortexpr = "";
$limit = 20;
$ranker = SPH_RANK_PROXIMITY_BM25;
$select = "";
for ( $i=0; $i<count($args); $i++ )
{
	$arg = $args[$i];

	if ( $arg=="-h" || $arg=="--host" )				$host = $args[++$i];
	else if ( $arg=="-p" || $arg=="--port" )		$port = (int)$args[++$i];
	else if ( $arg=="-i" || $arg=="--index" )		$index = $args[++$i];
	else if ( $arg=="-s" || $arg=="--sortby" )		{ $sortby = $args[++$i]; $sortexpr = ""; }
	else if ( $arg=="-S" || $arg=="--sortexpr" )	{ $sortexpr = $args[++$i]; $sortby = ""; }
	else if ( $arg=="-n" || $arg=="--any" )			$mode = SPH_MATCH_ANY;
	else if ( $arg=="-b" || $arg=="--boolean" )		$mode = SPH_MATCH_BOOLEAN;
	else if ( $arg=="-e" || $arg=="--extended" )	$mode = SPH_MATCH_EXTENDED;
	else if ( $arg=="-e2" )							$mode = SPH_MATCH_EXTENDED2;
	else if ( $arg=="-ph"|| $arg=="--phrase" )		$mode = SPH_MATCH_PHRASE;
	else if ( $arg=="-f" || $arg=="--filter" )		$filter = $args[++$i];
	else if ( $arg=="-v" || $arg=="--value" )		$filtervals[] = $args[++$i];
	else if ( $arg=="-g" || $arg=="--groupby" )		$groupby = $args[++$i];
	else if ( $arg=="-gs"|| $arg=="--groupsort" )	$groupsort = $args[++$i];
	else if ( $arg=="-d" || $arg=="--distinct" )	$distinct = $args[++$i];
	else if ( $arg=="-l" || $arg=="--limit" )		$limit = (int)$args[++$i];
	else if ( $arg=="--select" )					$select = $args[++$i];
	else if ( $arg=="-fr"|| $arg=="--filterrange" )	$cl->SetFilterRange ( $args[++$i], $args[++$i], $args[++$i] );
	else if ( $arg=="-r" )
	{
		$arg = strtolower($args[++$i]);
		if ( $arg=="bm25" )		$ranker = SPH_RANK_BM25;
		if ( $arg=="none" )		$ranker = SPH_RANK_NONE;
		if ( $arg=="wordcount" )$ranker = SPH_RANK_WORDCOUNT;
		if ( $arg=="fieldmask" )$ranker = SPH_RANK_FIELDMASK;
		if ( $arg=="sph04" )	$ranker = SPH_RANK_SPH04;
	}
	else
		$q .= $args[$i] . " ";
}

////////////
// do query
////////////

$cl->SetServer ( $host, $port );
$cl->SetConnectTimeout ( 1 );
$cl->SetArrayResult ( true );
$cl->SetWeights ( array ( 100, 1 ) );
$cl->SetMatchMode ( $mode );
if ( count($filtervals) )	$cl->SetFilter ( $filter, $filtervals );
if ( $groupby )				$cl->SetGroupBy ( $groupby, SPH_GROUPBY_ATTR, $groupsort );
if ( $sortby )				$cl->SetSortMode ( SPH_SORT_EXTENDED, $sortby );
if ( $sortexpr )			$cl->SetSortMode ( SPH_SORT_EXPR, $sortexpr );
if ( $distinct )			$cl->SetGroupDistinct ( $distinct );
if ( $select )				$cl->SetSelect ( $select );
if ( $limit )				$cl->SetLimits ( 0, $limit, ( $limit>1000 ) ? $limit : 1000 );
$cl->SetRankingMode ( $ranker );
$res = $cl->Query ( $q, $index );

/*
$strarr = array("I am writing a php file to complete my assignment of Software Engineering", "The demonstration is after majors but still we have to complete it");

$result = $cl->buildExcerpts($strarr, $index, "Software");
foreach($result as $arb => $ss)
	print "----------------------".$ss."\n\n";

*/

////////////////
// print me out
////////////////

if ( $res===false )
{
	print "Query failed: " . $cl->GetLastError() . ".\n";

} else
{
	if ( $cl->GetLastWarning() )
		print "WARNING: " . $cl->GetLastWarning() . "\n\n";

	print "Query '$q' retrieved $res[total] of $res[total_found] matches in $res[time] sec.\n";
	print "Query stats:\n";
	if ( is_array($res["words"]) )
		foreach ( $res["words"] as $word => $info )
			print "    '$word' found $info[hits] times in $info[docs] documents\n";
	print "\n";

	if ( is_array($res["matches"]) )
	{
	require_once("hmm.php");
	/*
	$ids = array_keys($res["matches"]);
	$docs = findit($ids);
	print $docs[2];
	$reply = $cl->BuildExcerpts($docs, 'test1', 'Algorithm');
	print $reply[0];
	die("");
	*/
	
	
	
		$n = 1;
		print "Matches:\n";
		$docs = array();
		foreach ( $res["matches"] as $docinfo )
		{
			print "$n. doc_id=$docinfo[id], weight=$docinfo[weight]";
			array_push($docs, findit($docinfo['id']));
			foreach ( $res["attrs"] as $attrname => $attrtype )
			{
				$value = $docinfo["attrs"][$attrname];
				if ( $attrtype==SPH_ATTR_MULTI || $attrtype==SPH_ATTR_MULTI64 )
				{
					$value = "(" . join ( ",", $value ) .")";
				} else
				{
					if ( $attrtype==SPH_ATTR_TIMESTAMP )
						$value = date ( "Y-m-d H:i:s", $value );
				}
				print ", $attrname=$value";
			}
			print "\n";
			$n++;
		}
		$n--;
		$reply = $cl->BuildExcerpts($docs, 'test1', $q, array("single_passage" => true));
		for($i=0;$i<$n;$i++)
			print $reply[$i];
	}
}

//
// $Id: test.php 2903 2011-08-04 13:30:49Z shodan $
//

?>