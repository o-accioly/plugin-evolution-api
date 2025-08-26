# Mautic WhatsApp Evolution API Plugin

Plugin para integração do Mautic 5.x com a Evolution API v2.x para envio de mensagens WhatsApp.

## Características

- Integração completa com Evolution API 2.x
- Interface de configuração no painel administrativo do Mautic
- Suporte para múltiplas instâncias WhatsApp
- Traduções em português e inglês

## Instalação

1. Faça o download ou clone este repositório
2. Copie a pasta `MauticEvolutionApiBundle` para o diretório `plugins/` do seu Mautic
3. Limpe o cache do Mautic:

   ```bash
   rm -rf var/cache/*
   ```

4. Acesse o painel administrativo do Mautic
5. Vá em Configurações > Plugins
6. Encontre "WhatsApp Evolution API" e clique em configurar

## Configuração

### Parâmetros obrigatórios

- **API URL**: URL da sua instância Evolution API (ex: `https://your-evolution-api.com`)
- **API Key**: Chave de API da Evolution
- **Instance ID**: ID da instância WhatsApp configurada na Evolution API

### Como obter as credenciais

1. Acesse sua instância Evolution API
2. Crie uma nova instância WhatsApp
3. Anote o Instance ID gerado
4. Obtenha a API Key nas configurações da Evolution API

## Estrutura do Plugin

```text
MauticEvolutionApiBundle/
├── Config/
│   ├── config.php
│   └── services.php
├── Form/
│   └── Type/
│       └── ConfigType.php
├── Integration/
│   └── WhatsAppEvolutionIntegration.php
├── DependencyInjection/
│   └── MauticWhatsAppEvolutionExtension.php
├── Translations/
│   ├── en_US/
│   │   └── messages.ini
│   └── pt_BR/
│       └── messages.ini
├── Assets/
│   └── img/
│       └── evolution-logo.png
└── MauticWhatsAppEvolutionBundle.php
```

## Requisitos

- Mautic 5.x
- PHP 8.1+
- Evolution API 2.x em funcionamento
- Instância WhatsApp configurada na Evolution API

## Suporte

Para dúvidas e suporte, abra uma issue neste repositório.

## Licença

Este plugin é distribuído sob a licença MIT.

## Autor

Gabriel Accioly
