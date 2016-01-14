<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


<xsl:template match="/">
<html>
<table border="1">
	<xsl:for-each select="//*[@id='calories-table']/tbody/tr" >
		<tr>
			
			<td>
			<xsl:value-of select="td[1]" />
			</td>
		
			<td>
			<xsl:value-of select="td[2]" />
			</td>
		
			<td>
			<xsl:value-of select="td[4]" />
			</td>
			<td>
			<xsl:value-of select="td[5]" />
			</td>
		
		</tr>
	</xsl:for-each >
</table>
</html>
</xsl:template>

</xsl:stylesheet>