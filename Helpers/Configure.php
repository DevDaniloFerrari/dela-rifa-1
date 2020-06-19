<?php
class Configure {

    public static function write($index)
    {
        $data = array(
            'gender' => array(
                '1' => 'Masculino',
                '2' => 'Feminino'
            ),
            'maritalStatus' => array(
                '1' => 'Solteiro',
                '2' => 'Casado',
                '3' => 'Divorciado',
                '4' => 'Separado'
            ),
            'state' => array(
                'AC' => 'Acre',
                'AL' => 'Alagoas - AL', 
                'AP' => 'Amapá - AP',
                'AM' => 'Amazonas - AM',
                'BA' => 'Bahia - BA',
                'CE' => 'Ceará - CE',
                'DF' => 'Distrito Federal - DF',
                'ES' => 'Espírito Santo - ES',
                'GO' => 'Goiás - GO',
                'MA' => 'Maranhão - MA',
                'MT' => 'Mato Grosso	- MT',
                'MS' => 'Mato Grosso do Sul - MS',
                'MG' => 'Minas Gerais - MG',
                'PA' => 'Pará - PA',
                'PB' => 'Paraíba - PB',
                'PR' => 'Paraná - PR',
                'PE' => 'Pernambuco - PE',
                'PI' => 'Piauí	- PI',
                'RJ' => 'Rio de Janeiro - RJ',
                'RN' => 'Rio Grande do Norte - RN',
                'RS' => 'Rio Grande do Sul - RS',
                'RO' => 'Rondônia - RO',
                'RR' => 'Roraima - RR',
                'SC' => 'Santa Catarina - SC',
                'SP' => 'São Paulo - SP',
                'SE' => 'Sergipe - SE',
                'TO' => 'Tocantins	 TO'
            ),
            'categories' => array(
                1 => 'administrador',
                4 => 'cliente'
            ),
            'productStatus' => array(
                1 => 'Aguardando sorteio',
                2 => 'Produto sorteado'
            )
        );
        return $data[$index];
    }

    public static function read($index, $value = null)
    {
        $data = Configure::write($index);
        return ($value != null) ? $data[$value] : $data;
    }

}

