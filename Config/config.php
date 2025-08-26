<?php

return [
    'name'        => 'WhatsApp Evolution API',
    'description' => 'Integração com a Evolution API para envio de mensagens WhatsApp.',
    'version'     => '1.0',
    'author'      => 'Mautic Community',

    // Opcional: podemos definir rotas aqui, mas não é necessário para exibir os campos da integração
    // 'routes' => [ ... ],

    'services' => [
        'integrations' => [
            'mautic.integration.evolutionapi' => [
                'class'     => \MauticPlugin\MauticEvolutionApiBundle\Integration\EvolutionApiIntegration::class,
                'arguments' => [
                    'event_dispatcher',
                    'mautic.helper.cache_storage',
                    'doctrine.orm.entity_manager',
                    'session',
                    'request_stack',
                    'router',
                    'translator',
                    'logger',
                    'mautic.helper.encryption',
                    'mautic.lead.model.lead',
                    'mautic.lead.model.company',
                    'mautic.helper.paths',
                    'mautic.core.model.notification',
                    'mautic.lead.model.field',
                    'mautic.plugin.model.integration_entity',
                    'mautic.lead.model.dnc',
                ],
            ],
        ],
    ],
];
