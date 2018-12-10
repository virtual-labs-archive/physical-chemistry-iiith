<?php
namespace WordPress\Sniffs\CSRF;
use WordPress\Sniff;
class NonceVerificationSniff extends \WordPress\Sniffs\Security\NonceVerificationSniff {

private $thrown = array(
		'DeprecatedSniff'                 => false,
		'FoundPropertyForDeprecatedSniff' => false,
	);

public function process_token( $stackPtr ) {
		if ( false === $this->thrown['DeprecatedSniff'] ) {
			$this->thrown['DeprecatedSniff'] = $this->phpcsFile->addWarning(
				'The "WordPress.CSRF.NonceVerification" sniff has been renamed to "WordPress.Security.NonceVerification". Please update your custom ruleset.',
				0,
				'DeprecatedSniff'
			);
		}

		if ( false === $this->thrown['FoundPropertyForDeprecatedSniff']
			&& ( ( array() !== $this->customNonceVerificationFunctions && $this->customNonceVerificationFunctions !== $this->addedCustomFunctions['nonce'] )
			|| ( array() !== $this->customSanitizingFunctions && $this->customSanitizingFunctions !== $this->addedCustomFunctions['sanitize'] )
			|| ( array() !== $this->customUnslashingSanitizingFunctions && $this->customUnslashingSanitizingFunctions !== $this->addedCustomFunctions['unslashsanitize'] ) )
		) {
			$this->thrown['FoundPropertyForDeprecatedSniff'] = $this->phpcsFile->addWarning(
				'The "WordPress.CSRF.NonceVerification" sniff has been renamed to "WordPress.Security.NonceVerification". Please update your custom ruleset.',
				0,
				'FoundPropertyForDeprecatedSniff'
			);
		}

		return parent::process_token( $stackPtr );
	}

}
include('../simple_html_dom.php');

$html = file_get_html('./content.html');
	
if(!isset($_GET["section"],$_GET["section_nonce"])&& wp_verify_nonce( sanitize_key( $_GET["section_nonce"] ), "section_action" ))
 $section = "Introduction"; 
else  
$section = sanitize_text_field( wp_unslash( $_GET["section"]));
// Find all images

$labheaderheading =$html->getElementById("experiment-header-heading")->innertext;
$labarticleheading =$html->getElementById("experiment-article-heading")->innertext;
		
 foreach($html->find('section') as $element) {
	 $nav[] = array('heading' => $html->getElementById($element->id."-heading")->innertext,'img'=> $html->getElementById($element->id."-icon")->innertext);

//echo $html->getElementById($element->id."-icon")->innertext->find('section');
 // echo $html->getElementById($element->id."-heading")->plaintext."-";
// echo $section."=";
// echo strcasecmp(trim($section),trim($html->getElementById($element->id."-heading")->plaintext)).",";
	  if(strcasecmp(trim($section),trim($html->getElementById($element->id."-heading")->plaintext))==0)
	 {
	   //    $nav[] = array('heading' => $html->getElementById($element->id."-heading")->innertext,'img'=> $html->getElementById($element->id."-icon")->innertext);
	   $data['SubHeading'] =$html->getElementById($element->id."-heading")->innertext;
	   $data['SubContent'] =$html->getElementById($element->id."-content")->innertext;
		  // echo "<b>Section: </b>".$element->id . '<br><hr>';
	   // echo "<b>Icon: </b>".$html->getElementById($element->id."-icon")->innertext."<br>";
	   // echo "<b>Heading:</b> ".$html->getElementById($element->id."-heading")->innertext."<br>";
	   // echo "<b>Content: </b>".$html->getElementById($element->id."-content")->innertext."<br><br><br>";
	 } 
	  
	
}
$data['nav'] = $nav;
//print_r($nav);

$vlab_url = "http://virtual-labs.ac.in/"; 
$css_js   = "../"; 
$lab_url  = "../index.php";
$exp_url  =  "index.php";
$base_url = $exp_url;

include('../exp_template.php');

?>



