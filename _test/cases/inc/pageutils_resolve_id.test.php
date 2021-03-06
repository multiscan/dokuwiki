<?php
require_once DOKU_INC.'inc/utf8.php';
require_once DOKU_INC.'inc/pageutils.php';

class init_resolve_id_test extends UnitTestCase {


    function test1(){
        // we test multiple cases here
        // format: $ns, $page, $output
        $tests   = array();

        // relative current in root
        $tests[] = array('','page','page');
        $tests[] = array('','.page','page');
        $tests[] = array('','.:page','page');

        // relative current in namespace
        $tests[] = array('lev1:lev2','page','lev1:lev2:page');
        $tests[] = array('lev1:lev2','.page','lev1:lev2:page');
        $tests[] = array('lev1:lev2','.:page','lev1:lev2:page');

        // relative upper in root
        $tests[] = array('','..page','page');
        $tests[] = array('','..:page','page');

        // relative upper in namespace
        $tests[] = array('lev1:lev2','..page','lev1:page');
        $tests[] = array('lev1:lev2','..:page','lev1:page');
        $tests[] = array('lev1:lev2','..:..:page','page');
        $tests[] = array('lev1:lev2','..:..:..:page','page');

        // strange and broken ones
        $tests[] = array('lev1:lev2','....:....:page','lev1:lev2:page');
        $tests[] = array('lev1:lev2','..:..:lev3:page','lev3:page');
        $tests[] = array('lev1:lev2','..:..:lev3:..:page','page');
        $tests[] = array('lev1:lev2','..:..:lev3:..:page:....:...','page');

        foreach($tests as $test){
            $this->assertEqual(resolve_id($test[0],$test[1]),$test[2]);
        }
    }

}
//Setup VIM: ex: et ts=4 enc=utf-8 :
