<?php
namespace Aura\Web;

use Aura\Web\Request\PropertyFactory;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    protected function newRequest(array $globals = array())
    {
        $factory = new WebFactory($globals);
        return $factory->newRequest();
    }
    
    public function test__get()
    {
        $request = $this->newRequest();
        
        $this->assertNotNull($request->cookies);
        $this->assertNotNull($request->env);
        $this->assertNotNull($request->files);
        $this->assertNotNull($request->headers);
        $this->assertNotNull($request->content);
        $this->assertNotNull($request->method);
        $this->assertNotNull($request->accept);
        $this->assertNotNull($request->post);
        $this->assertNotNull($request->query);
        $this->assertNotNull($request->server);
        $this->assertNotNull($request->url);
    }
    
    public function testIsXhr()
    {
        $request = $this->newRequest();
        $this->assertFalse($request->isXhr());
        
        $request = $this->newRequest(array(
            '_SERVER' => array(
                'HTTP_X_REQUESTED_WITH' => 'xxx',
            ),
        ));
        $this->assertFalse($request->isXhr());
        
        $request = $this->newRequest(array(
            '_SERVER' => array(
                'HTTP_X_REQUESTED_WITH' => 'XmlHttpRequest',
            ),
        ));
        $this->assertTrue($request->isXhr());
        
    }

}
