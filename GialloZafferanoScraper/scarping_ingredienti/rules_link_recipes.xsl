<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


<xsl:template match="/">
<html>
<div id="results">

			<xsl:for-each select='//*[@id="content"]/div[1]/h2'>
			
			<span>
				<xsl:value-of select='a/@href' />
			</span>
			
			</xsl:for-each>
</div>

</html>
</xsl:template>

</xsl:stylesheet>