<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


<xsl:template match="/">
<html>
<div id="results">
			
			<h1 id="nome"><xsl:value-of select='//*[@id="page"]/div[7]/div[1]/h1' /> </h1>
			<h2 id="course"> <xsl:value-of select='//*[@id="page"]/div[7]/div[1]/a' /> </h2>
			<h3 id="serves"><xsl:value-of select='//*[@id="rInfos"]/li[4]/strong' /> </h3>
			
			
			
			<xsl:for-each select='//*[@id="page"]/div[7]/div[1]/div[2]/div[2]/div[3]/dl/dd'>
			
			<h4>
				<xsl:value-of select='a' />
			</h4>
			<h4>
			
				<xsl:value-of select='.' />
			</h4>
			
			</xsl:for-each>
			
			<xsl:for-each select='//*[@id="page"]/div[7]/div[1]/div[3]/div[2]/div[3]/dl[2]/dd'>
			
			<h4>
				<xsl:value-of select='a' />
			</h4>
			<h4>
			
				<xsl:value-of select='.' />
			</h4>
			
			</xsl:for-each>
			
			<xsl:for-each select='//*[@id="page"]/div[7]/div[1]/div[2]/p'>
			
			<h5>
			
				<xsl:value-of select='.' />
			</h5>
			
			</xsl:for-each>
			<xsl:for-each select='//*[@id="page"]/div[7]/div[1]/div[3]/p'>
			
			<h5>
			
				<xsl:value-of select='.' />
			</h5>
			
			</xsl:for-each>
			<h6 id="serves"><xsl:value-of select='//*[@id="rInfos"]/li[2]/strong' /> </h6>
			<h7 id="serves"><xsl:value-of select='//*[@id="rInfos"]/li[3]/strong' /> </h7>
		
</div>

</html>
</xsl:template>

</xsl:stylesheet>