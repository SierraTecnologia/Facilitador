<?php

namespace Facilitador\FormFields;

class TimestampHandler extends AbstractHandler
{
    protected $codename = 'timestamp';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('facilitador::formfields.timestamp', [
            'row'             => $row,
            'options'         => $options,
            'dataType'        => $dataType,
            'dataTypeContent' => $dataTypeContent,
        ]);
    }
}
