<?php

namespace LaraDumps\LaraDumpsCore\Payloads;

class PhpInfoPayload extends Payload
{
    public function __construct(

    ) {
    }

    public function type(): string
    {
        return 'table';
    }

    public function content(): array
    {
        $phpinfo = [
            'PHP version'          => phpversion(),
            'Memory limit'         => ini_get('memory_limit'),
            'Max file upload size' => ini_get('max_file_uploads'),
            'Max post size'        => ini_get('post_max_size'),
            'ini file'             => php_ini_loaded_file(),
            'Extensions'           => implode(', ', get_loaded_extensions()),
        ];

        foreach ($phpinfo as $key => $value) {
            /** @var array<string> $values */
            $values[] = [
                'property' => $key,
                'value'    => $value,
            ];
        }

        return [
            'fields' => [
                'property',
                'value',
            ],
            'values' => $values,
            'header' => [
                'Property',
                'Value',
            ],
        ];
    }

    public function toScreen(): array|Screen
    {
        return [];
    }

    public function withLabel(): array|Label
    {
        return new Label('PHPINFO');
    }
}
