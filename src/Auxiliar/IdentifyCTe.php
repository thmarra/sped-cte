<?php

namespace NFePHP\CTe\Auxiliar;

/**
 * Classe para a identificação do documento eletrônico da NFe
 *
 * @category  NFePHP
 * @package   NFePHP\CTe\Identify
 * @copyright Copyright (c) 2008-2015
 * @license   http://www.gnu.org/licenses/lesser.html LGPL v3
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/nfephp for the canonical source repository
 */

use NFePHP\Common\Identify\Identify;

class IdentifyCTe
{
    public static function identificar($xml = '', &$aResp = array())
    {
        $aList = array(
            'consReciCTe' => 'consReciCTe',
            'consSitCTe' => 'consSitCTe',
            'consStatServCTe' => 'consStatServCTe',
            'enviCTe' => 'enviCTe',
            'evCancCTe' => 'evCancCTe',
            'evEncCTe' => 'evEncCTe',
            'CTe' => 'cte',
            'eventoCTe' => 'eventoCTe',
            'procEventoCTe' => 'procEventoCTe',
            'mdfeProc' => 'procCTe',
            'retConsReciCTe' => 'retConsReciCTe',
            'retConsSitCTe' => 'retConsSitCTe',
            'retConsStatServCTe' => 'retConsStatServCTe',
            'retEnviCTe' => 'retEnviCTe',
            'retEventoCTe' => 'retEventoCTe'
        );
        Identify::setListSchemesId($aList);
        $schem = Identify::identificacao($xml, $aResp);
        $dom = $aResp['dom'];
        $node = $dom->getElementsByTagName($aResp['tag'])->item(0);
        if ($schem == 'cte') {
            //se for um nfe então é necessário pegar a versão
            // em outro node infNFe
            $node1 = $dom->getElementsByTagName('infCte')->item(0);
            $versao = $node1->getAttribute('versao');
        } else {
            $versao = $node->getAttribute('versao');
        }
        $aResp['versao'] = $versao;
        $aResp['xml'] = $dom->saveXML($node);
        return $schem;
    }
}
