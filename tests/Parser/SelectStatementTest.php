<?php

namespace SqlParser\Tests\Parser;

use SqlParser\Tests\TestCase;

use SqlParser\Parser;

class SelectStatementTest extends TestCase
{

    public function testSelectOptions()
    {
        $data = $this->getData('parser/parseSelect');
        $parser = new Parser($data['query']);
        $stmt = $parser->statements[0];
        $this->assertEquals(10, $stmt->options->has('MAX_STATEMENT_TIME'));
    }

    /**
     * @dataProvider testSelectProvider
     */
    public function testSelect($test)
    {
        $this->runParserTest($test);
    }

    public function testSelectProvider()
    {
        return array(
            array('parser/parseSelect2'),
            array('parser/parseSelect3'),
            array('parser/parseSelect4'),
            array('parser/parseSelect5'),
            array('parser/parseSelect6'),
            array('parser/parseSelect7'),
            array('parser/parseSelect8'),
            array('parser/parseSelect9'),
            array('parser/parseSelect10'),
            array('parser/parseSelectErr1'),
            array('parser/parseSelectNested'),
            array('parser/parseSelectCase1'),
            array('parser/parseSelectCase2'),
            array('parser/parseSelectCase3'),
            array('parser/parseSelectCase4'),
            array('parser/parseSelectCase5'),
            array('parser/parseSelectCaseErr1'),
            array('parser/parseSelectCaseErr2'),
            array('parser/parseSelectCaseErr3'),
            array('parser/parseSelectCaseErr4'),
            array('parser/parseSelectCaseErr5'),
            array('parser/parseSelectIntoOptions1'),
            array('parser/parseSelectIntoOptions2'),
            array('parser/parseSelectIntoOptions3'),
            array('parser/parseSelectJoinCross'),
            array('parser/parseSelectJoinNatural'),
            array('parser/parseSelectJoinNaturalLeft'),
            array('parser/parseSelectJoinNaturalRight'),
            array('parser/parseSelectJoinNaturalLeftOuter'),
            array('parser/parseSelectJoinNaturalRightOuter'),
            array('parser/parseSelectJoinMultiple'),
            array('parser/parseSelectJoinMultiple2'),
            array('parser/parseSelectWrongOrder'),
            array('parser/parseSelectEndOptions1'),
            array('parser/parseSelectEndOptions2'),
            array('parser/parseSelectEndOptionsErr'),
            array('parser/parseSelectUnion'),
            array('parser/parseSelectUnion2'),
        );
    }
}
