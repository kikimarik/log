<?php

namespace kikimarik\lognote\tests\unit\level;

use Codeception\Test\Unit;
use kikimarik\lognote\core\LogLevel;
use kikimarik\lognote\level\DebugLogLevel;
use kikimarik\lognote\level\ErrorLogLevel;
use kikimarik\lognote\level\FatalLogLevel;
use kikimarik\lognote\level\InfoLogLevel;
use kikimarik\lognote\level\NoticeLogLevel;
use kikimarik\lognote\level\WarningLogLevel;

final class DebugLogLevelTest extends Unit
{
    /**
     * @return void
     */
    public function testWeigh(): void
    {
        $level = new DebugLogLevel();
        $result = $level->weigh();
        $this->assertEquals(1, $result);
    }

    /**
     * @dataProvider testAssertLessThenOrEqualProvider
     * @param LogLevel $inputLevel
     * @param bool $expected
     * @return void
     */
    public function testAssertLessThenOrEqual(LogLevel $inputLevel, bool $expected): void
    {
        $level = new DebugLogLevel();
        $result = $level->assertLessThenOrEqual($inputLevel);
        $this->assertEquals($expected, $result);
    }

    public function testAssertLessThenOrEqualProvider(): array
    {
        return [
            /* Imaginary log level with 0 weight for example */
            [new FakeLogLevel("fake", 0), false],
            /* Debug log level */
            [new DebugLogLevel(), true],
            /* Info log level */
            [new InfoLogLevel(), true],
            /* Notice log level */
            [new NoticeLogLevel(), true],
            /* Warning log level */
            [new WarningLogLevel(), true],
            /* Error log level */
            [new ErrorLogLevel(), true],
            /* Fatal log level */
            [new FatalLogLevel(), true],
        ];
    }
}
