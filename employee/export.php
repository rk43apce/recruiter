<?php  
//export.php  

header("Content-type: application/vnd.ms-word");  
header("Content-Disposition: attachment;Filename=".rand().".doc");  
header("Pragma: no-cache");  
header("Expires: 0");  

?>

<p>&nbsp;</p>
<table>
<tbody>
<tr>
<td>
<p><em><span style="font-weight: 400;">Name: </span></em></p>
<p><strong>(CANDIDATE NAME)</strong></p>
</td>
<td>
<p><span style="font-weight: 400;">Position Applied For: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
<p><strong>(CLIENT &amp; ROLE NAME)</strong></p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table>
<tbody>
<tr>
<td>
<p><em><span style="font-weight: 400;">Date of Birth</span></em></p>
</td>
<td>
<p><span style="font-weight: 400;">(Date)</span></p>
</td>
<td>
<p><em><span style="font-weight: 400;">Work Experience</span></em></p>
</td>
<td colspan="2">
<p><span style="font-weight: 400;">(Value in years/months)</span></p>
</td>
</tr>
<tr>
<td>
<p><em><span style="font-weight: 400;">Current Annual CTC</span></em></p>
</td>
<td>
<p><span style="font-weight: 400;">(Value / currency)</span></p>
</td>
<td>
<p><em><span style="font-weight: 400;">Fixed:</span></em><span style="font-weight: 400;"> (free text)</span></p>
</td>
<td colspan="2">
<p><span style="font-weight: 400;">Variable: (free text)</span></p>
</td>
</tr>
<tr>
<td>
<p><em><span style="font-weight: 400;">Desired CTC</span></em></p>
</td>
<td>
<p><span style="font-weight: 400;">(free text)</span></p>
</td>
<td>&nbsp;</td>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td>
<p><em><span style="font-weight: 400;">City residing in</span></em></p>
</td>
<td>
<p><span style="font-weight: 400;">(City list)</span></p>
</td>
<td>
<p><em><span style="font-weight: 400;">Willing to relocate</span></em></p>
</td>
<td colspan="2">
<p><span style="font-weight: 400;">(Free text)</span></p>
</td>
</tr>
<tr>
<td>
<p><em><span style="font-weight: 400;">Notice Period</span></em></p>
</td>
<td>
<p><span style="font-weight: 400;">(Value in months)</span></p>
</td>
<td>
<p><em><span style="font-weight: 400;">Currently Working</span></em></p>
</td>
<td colspan="2">
<p><span style="font-weight: 400;">(Yes / No)</span></p>
</td>
</tr>
<tr>
<td>
<p><em><span style="font-weight: 400;">Applied before</span></em></p>
</td>
<td>
<p><span style="font-weight: 400;">(Yes / No)</span></p>
</td>
<td>
<p><em><span style="font-weight: 400;">If Yes, when</span></em></p>
</td>
<td colspan="2">
<p><span style="font-weight: 400;">(Free text)</span></p>
</td>
</tr>
</tbody>
</table>
<p><em><span style="font-weight: 400;">Candidate Contact(s)</span></em></p>
<table>
<tbody>
<tr>
<td>
<p><em><span style="font-weight: 400;">Primary Mobile</span></em></p>
</td>
<td>
<p><span style="font-weight: 400;">(country code &ndash; number)</span></p>
</td>
<td>
<p><em><span style="font-weight: 400;">Alternate Mobile</span></em></p>
</td>
<td>
<p><span style="font-weight: 400;">(country code &ndash; number)</span></p>
</td>
</tr>
<tr>
<td>
<p><em><span style="font-weight: 400;">Primary E-mail</span></em></p>
</td>
<td>
<p><span style="font-weight: 400;">(email address)</span></p>
</td>
<td>
<p><em><span style="font-weight: 400;">Alternate E-mail</span></em></p>
</td>
<td>
<p><span style="font-weight: 400;">(email address)</span></p>
</td>
</tr>
</tbody>
</table>
<p><em><span style="font-weight: 400;">Positions Held (last 5)</span></em></p>
<table>
<tbody>
<tr>
<td>
<p><em><span style="font-weight: 400;">From</span></em></p>
</td>
<td>
<p><em><span style="font-weight: 400;">To</span></em></p>
</td>
<td>
<p><em><span style="font-weight: 400;">Organisation</span></em></p>
</td>
<td>
<p><em><span style="font-weight: 400;">Designation</span></em></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-weight: 400;">(month-year)</span></p>
</td>
<td>
<p><span style="font-weight: 400;">(month-year)</span></p>
</td>
<td>
<p><span style="font-weight: 400;">(free text)</span></p>
</td>
<td>
<p><span style="font-weight: 400;">(free text)</span></p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<p><em><span style="font-weight: 400;">Qualifications (up to 3)</span></em></p>
<table>
<tbody>
<tr>
<td>
<p><em><span style="font-weight: 400;">Year</span></em></p>
</td>
<td>
<p><em><span style="font-weight: 400;">Degree</span></em></p>
</td>
<td>
<p><em><span style="font-weight: 400;">Institute</span></em></p>
</td>
<td>
<p><em><span style="font-weight: 400;">Remarks</span></em></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-weight: 400;">(Year)</span></p>
</td>
<td>
<p><span style="font-weight: 400;">(free text)</span></p>
</td>
<td>
<p><span style="font-weight: 400;">(free text)</span></p>
</td>
<td>
<p><span style="font-weight: 400;">(free text)</span></p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<p><em><span style="font-weight: 400;">Qualitative Assessment (scale of 10)</span></em></p>
<table>
<tbody>
<tr>
<td>
<p><span style="font-weight: 400;">Communication: </span></p>
</td>
<td>
<p><span style="font-weight: 400;">Confidence: </span></p>
</td>
<td>
<p><span style="font-weight: 400;">Energy: </span></p>
</td>
<td>
<p><span style="font-weight: 400;">Attitude: </span></p>
</td>
<td>
<p><span style="font-weight: 400;">Finesse: </span></p>
</td>
</tr>
</tbody>
</table>
<p><em><span style="font-weight: 400;">Recruiter Notes</span></em></p>
<table>
<tbody>
<tr>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<p><em><span style="font-weight: 400;">As on date:</span></em> <em><span style="font-weight: 400;">Confidential</span></em></p>
  
