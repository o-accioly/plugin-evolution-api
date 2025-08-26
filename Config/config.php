<?php

return [
    'name'        => 'WhatsApp Connector',
    'description' => 'WhatsApp messaging integration for Mautic',
    'version'     => '1.0',
    'author'      => 'Mautic Community',

    'services' => [
        'integrations' => [
            'mautic.integration.whatsapp_connector' => [
                'class'     => \MauticPlugin\MauticEvolutionApiBundle\Integration\WhatsAppConnectorIntegration::class,
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
