<?php

require_once dirname(dirname(dirname(__FILE__))). '/src/wordpress/splurgy-lib/SplurgyEmbed.php';
/*
 * All tests will delete your original token.
 */
class SplurgyEmbedTest extends PHPUnit_Framework_TestCase
{
    protected $splurgyEmbed;
    protected $token;
    protected $templateName;
    protected $offerId;

    protected function setUp()
    {
        $this->token = 'c_0123456789012345678901234567890123456789';
        $this->templateName = 'offers';
        $this->offerId = '1';
        $this->splurgyEmbed = new SplurgyEmbed();
    }

    protected function tearDown()
    {

    }

    public function testGetEmbedReturnObjectSplurgyEmbedGenerator()
    {
        $this->assertInstanceOf(
                    'SplurgyEmbedGenerator',
                    $this->splurgyEmbed->getEmbed()
                );
    }

    public function testGetToken() {
        $this->splurgyEmbed->setToken($this->token);
        $this->assertEquals(
                $this->token,
                $this->splurgyEmbed->getToken()
            );
    }

    public function testExceptionSetTokenIsCorrectFormat() {
        try{
            $this->splurgyEmbed->setToken("hellotoken");
        }
        catch(TokenErrorException $expected){
            return;
        }
        $this->fail("setToken is not in correct format Exception has not been raised");
    }

    public function testExceptionSetTokenIsEmpty() {
        try{
            $this->splurgyEmbed->setToken("      ");
        }
        catch(TokenErrorException $expected){
            return;
        }
        $this->fail("setToken is empty Exception has not been raised");
    }

    public function testExceptionSetTokenIsAlphaNumeric() {
        $this->splurgyEmbed->setToken('c_0123456789012345678901234567890123456789');
        $this->assertEquals('c_0123456789012345678901234567890123456789', $this->splurgyEmbed->getToken());
    }

    public function testSetTokenNotEmpty() {
        $this->splurgyEmbed->setToken($this->token);
        $this->assertEquals(
                    $this->token,
                    $this->splurgyEmbed->getToken()
                );
    }


    public function testCreateTokenConfig() {
        $filename = dirname(dirname(dirname(__FILE__))). '/src/wordpress/splurgy-lib/token.config';
        unlink($filename);
        if(file_exists($filename)) {
            $this->fail("File was not deleted");
        }
        $newEmbed = new SplurgyEmbed();
    }

    public function testDeleteTokenReturnEmptyString(){
        $this->splurgyEmbed->setToken($this->token);
        $this->splurgyEmbed->deleteToken();
        $this->assertEquals("", $this->splurgyEmbed->getToken());
    }
}
?>
