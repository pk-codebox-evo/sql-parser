<?php

use SqlParser\Parser;
use SqlParser\Utils\Misc;

class MiscTest extends TestCase
{

    /**
     * @dataProvider getAliasesProvider
     */
    public function testGetAliases($query, $db, array $expected)
    {
        $parser = new Parser($query);
        $this->assertEquals($expected, Misc::getAliases($parser->statements[0], $db));
    }

    public function getAliasesProvider()
    {
        return array(
            array(
                'select i.name as `n`,abcdef gh from qwerty i',
                'mydb',
                array(
                    'mydb' => array(
                        'alias' => null,
                        'tables' => array(
                            'qwerty' => array(
                                'alias' => 'i',
                                'columns' => array(
                                    'name' => 'n',
                                    'abcdef' => 'gh'
                                )
                            )
                        )
                    )
                )
            ),
            array(
                'select film_id id,title from film',
                'sakila',
                array(
                    'sakila' => array(
                        'alias' => null,
                        'tables' => array(
                            'film' => array(
                                'alias' => null,
                                'columns' => array(
                                    'film_id' => 'id'
                                )
                            )
                        )
                    )
                )
            ),
            array(
                'select `sakila`.`A`.`actor_id` as aid,`F`.`film_id` `fid`,'
                . 'last_update updated from `sakila`.actor A join `film_actor` as '
                . '`F` on F.actor_id = A.`actor_id`',
                'sakila',
                array(
                    'sakila' => array(
                        'alias' => null,
                        'tables' => array(
                            'film_actor' => array(
                                'alias' => 'F',
                                'columns' => array(
                                    'film_id' => 'fid',
                                    'last_update' => 'updated'
                                )
                            ),
                            'actor' => array(
                                'alias'=> 'A',
                                'columns' => array(
                                    'actor_id' => 'aid',
                                    'last_update' => 'updated'
                                )
                            )
                        )
                    )
                )
            ),
        );
    }

}