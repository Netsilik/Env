<?php
namespace Tests\env;

/**
 * @copyright (c) 2011-2016 Netsilik (http://netsilik.nl)
 * @license       EUPL-1.1 (European Union Public Licence, v1.1)
 */

use Tests\BaseTestCase;
use function App\Helpers\functions\env;


class GetEnvVariableTest extends BaseTestCase
{
	public function test_whenEnvironmentVariableDoesNotExist_TriggersWarningAndReturnsNull()
	{
		$result = env('TEST_FOO_BAR');
		
		self::assertErrorTriggered(E_USER_WARNING, "Environment variable TEST_FOO_BAR does not exist");
		
		self::assertNull($result);
	}
	
	public function test_whenEnvironmentVariableIsQuotedValue_ValueReturnedAsString()
	{
		putenv('TEST_FOO_BAR="true"');
		
		$result = env('TEST_FOO_BAR');
		
		self::assertEquals('true', $result);
	}
	
	public function test_whenEnvironmentVariableIsStringTrue_ValueReturnedAsBooleanTrue()
	{
		putenv('TEST_FOO_BAR=true');
		
		$result = env('TEST_FOO_BAR');
		
		self::assertTrue($result);
	}
	
	public function test_whenEnvironmentVariableIsStringFalse_ValueReturnedAsBooleanFalse()
	{
		putenv('TEST_FOO_BAR=fAlsE');
		
		$result = env('TEST_FOO_BAR');
		
		self::assertFalse($result);
	}
	
	public function test_whenEnvironmentVariableIsStringNull_ValueReturnedAsNull()
	{
		putenv('TEST_FOO_BAR=NuLL');
		
		$result = env('TEST_FOO_BAR');
		
		self::assertNull($result);
	}
	
	public function test_whenEnvironmentVariableIsNumericIntegerString_ValueReturnedAsInteger()
	{
		putenv('TEST_FOO_BAR=123');
		
		$result = env('TEST_FOO_BAR');
		
		self::assertEquals(123, $result);
	}
	
	public function test_whenEnvironmentVariableIsNumericFloatString_ValueReturnedAsFloat()
	{
		putenv('TEST_FOO_BAR=10.95');
		
		$result = env('TEST_FOO_BAR');
		
		self::assertEquals(10.95, $result);
	}
	
	public function test_whenEnvironmentVariableIsOtherString_ValueReturnedAsString()
	{
		putenv('TEST_FOO_BAR=x123x');
		
		$result = env('TEST_FOO_BAR');
		
		self::assertEquals('x123x', $result);
	}
}
