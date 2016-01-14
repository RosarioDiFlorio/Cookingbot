<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


<xsl:template match="/">
<html>
<table border="1">
	<xsl:for-each select="//*[@id='menu-calorie-tables']/li" >
		<tr>
			<td>
			<xsl:value-of select="a" />
			</td>
			<td>
			<xsl:value-of select="a/@href" />
			</td>
		</tr>
	</xsl:for-each >
</table>
</html>
</xsl:template>

</xsl:stylesheet>