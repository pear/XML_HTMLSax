<?php
/***
 * $Id$
 * Shows the impact of XML_OPTION_FULL_ESCAPES when parsing Word documents
 * saved as HTML
 */
define ( 'XML_HTMLSAX','../../');
require_once(XML_HTMLSAX.'HTMLSax.php');

class MyHandler {
    function escape($parser,$data) {
        echo('<pre>'.$data."\n\n\n</pre>");
    }
}

$h = & new MyHandler();

// Instantiate the parser
$parser=& new XML_HTMLSax();

$parser->set_object($h);
$parser->set_escape_handler('escape');

if ( isset($_GET['use_escapes']) ) {
    $parser->set_option('XML_OPTION_FULL_ESCAPES');
}
?>
<h1>Parsing Word Documents</h1>
<p>Shows HTMLSax parsing a simple Word generated HTML document and the impact of the option 'XML_OPTION_FULL_ESCAPES' which can be set like;
<pre>
$parser->set_option('XML_OPTION_FULL_ESCAPES');
</pre>
</p>
<p>Word generates some strange XML / HTML escape sequences like &lt;![endif]&gt; - now (3.0.0+) handled by HTMLSax correctly.</p>
<p>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>">View without XML_OPTION_FULL_ESCAPES</a> :
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?use_escapes=1">View with XML_OPTION_FULL_ESCAPES</a>
</p>
<p>Starting to parse...</p>
<?php
// Parse the document
$parser->parse(file_get_contents('worddoc.htm'));
?>
<p>Parsing completed</p>