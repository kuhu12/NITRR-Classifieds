<?php 
defined('_KUHUG') or die('Restricted Access.');

$cmnStyle = "font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; ";
$cmnStyle1 = "font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0 auto; ";
$cmnStyle2 = "font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 16px; margin: 0; ";

$Eml_wdth = 650; 
$linkStyle = $cmnStyle.'color: #FFF; text-decoration: none; line-height: 2; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background: #348eda; border-color: #348eda; border-style: solid; border-width: 10px 20px; ';
$v_algn_tp = 'vertical-align: top; ';

function getEmailParagraph($text) {
	global $cmnStyle, $v_algn_tp;
	$html = '<tr style="'.$cmnStyle.'">';
		$html .= '<td class="content-block" style="'.$cmnStyle.$v_algn_tp.'padding: 0 0 20px;" valign="top">';
			$html .= $text;
		$html .= '</td>';
	$html .= '</tr>';

return $html;
}

function getEmailLinkBtn($link, $label) {
	global $linkStyle;
	$html = '<a href="'.$link.'" class="btn-primary" style="'.$linkStyle.'">'.$label.'</a>';
return $html;
}

function getEmailBoldText($text) {
	global $cmnStyle;
	$html = '<strong style="'.$cmnStyle.'">'.$text.'</strong>';
return $html;
}

function getEmailBodyHeader($header) {
	global $cmnStyle, $cmnStyle1, $cmnStyle2, $v_algn_tp, $Eml_wdth;
	$html = '<table class="body-wrap" style="'.$cmnStyle.'width: 100%; background: #f6f6f6;">';
		$html .= '<tr style="'.$cmnStyle.'">';
			$html .= '<td style="'.$cmnStyle.$v_algn_tp.'" valign="top"></td>';
			$html .= '<td class="container" width="'.$Eml_wdth.'" style="'.$cmnStyle1.$v_algn_tp.'display: block !important; max-width: '.$Eml_wdth.'px !important; clear: both !important;" valign="top">';
				$html .= '<div class="content" style="'.$cmnStyle1.'max-width: '.$Eml_wdth.'px; display: block;padding: 20px;">';
					$html .= '<table class="main" width="100%" cellpadding="0" cellspacing="0" style="'.$cmnStyle.'border-radius: 3px; background: #fff; border: 1px solid #e9e9e9;">';
						$html .= '<tr style="'.$cmnStyle.'">';
							$html .= '<td class="alert alert-warning" style="'.$cmnStyle2.$v_algn_tp.'color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background: #FF9F00; padding: 20px;" align="center" valign="top">'.$header.'</td>';
						$html .= '</tr>';
						$html .= '<tr style="'.$cmnStyle.'">';
							$html .= '<td class="content-wrap" style="'.$cmnStyle.$v_algn_tp.'padding: 20px;" valign="top">';
								$html .= '<table width="100%" cellpadding="0" cellspacing="0" style="'.$cmnStyle.'">';
return $html; 
}

function getEmailBodyFooter() {
	global $cmnStyle, $v_algn_tp;
	
	$thank_msg = 'Best Regards,<br />'.getEmailBoldText(SITE_NAME);
	$html = getEmailParagraph($thank_msg);
	
	$html .= '</table></td></tr></table></div></td>';
	$html .= '<td style="'.$cmnStyle.$v_algn_tp.'" valign="top"></td>';
	$html .= '</tr></table>';
	
return $html;
} 