# MauticEvolutionApiBundle — Integração WhatsApp Evolution API (Mautic 5)

Este plugin adiciona uma integração com a Evolution API (v2.2.3+) para envio de mensagens WhatsApp a partir do Mautic. Ele cria uma integração do tipo “API” com os campos de configuração necessários e expõe serviços para envio de texto, imagens (por URL) e vídeos (por URL). Um endpoint de webhook também está disponível para receber atualizações de status das mensagens.

Observação: nesta versão a integração já pode ser utilizada por serviços internos; a disponibilização como “Canal de Mensagem” nativo no Mautic poderá ser adicionada em versões futuras.

## Requisitos
- Mautic 5.x
- PHP compatível com sua instalação do Mautic (>= 8.1 para Mautic 5)
- Acesso a uma instância da Evolution API 2.2.3 ou superior
- As credenciais/variáveis da Evolution API:
  - api_url
  - api_key
  - instance_id

## Instalação
Você pode instalar o plugin manualmente (recomendado) ou via Composer (para ambientes que versionam os plugins).

### 1) Instalação manual
1. Baixe ou copie esta pasta para dentro de plugins do Mautic:
   - Caminho final deve ser: plugins/MauticEvolutionApiBundle
2. Verifique as permissões de arquivo adequadas para o seu ambiente web/PHP.
3. Limpe o cache e recarregue os plugins:
   - Pelo terminal, a partir da raiz do Mautic:
     - php bin/console cache:clear
     - php bin/console mautic:plugins:reload
   - ou, na interface do Mautic: Configurações > Plugins > botão “Instalar/Atualizar Plugins”.

### 2) Instalação via Composer (opcional)
Se você mantém os plugins via Composer, adicione o repositório e o pacote. Exemplo genérico:

1. No composer.json da raiz do Mautic, adicione um repositório (se for privado/local, ajuste conforme sua origem):

   "repositories": [
     { "type": "path", "url": "plugins/MauticEvolutionApiBundle" }
   ]

2. Instale o pacote:

   composer require mautic/plugin-evolution-api:dev-main

3. Limpe o cache e recarregue os plugins:

   php bin/console cache:clear
   php bin/console mautic:plugins:reload

## Ativação e Configuração
1. Acesse Mautic > Configurações (ícone de engrenagem) > Plugins.
2. Procure por “WhatsApp Evolution API” (nome interno: EvolutionApi).
3. Abra o plugin e preencha os campos em “Credenciais/Chaves” (Keys):
   - API URL (api_url): URL base da sua Evolution API (ex.: https://api.suaevolution.com)
   - API Key (api_key): chave de autenticação fornecida pela Evolution API
   - Instance ID (instance_id): identificador da instância no provedor Evolution
4. Salve as configurações.

## Webhook de Status (opcional, recomendado)
O plugin expõe um endpoint para receber callbacks de status de mensagens enviadas via Evolution API:
- Método: POST
- URL: https://SEU-MAUTIC/evolution/webhook
- Conteúdo: JSON de acordo com o que a Evolution API envia para atualizações (entregue/lida, etc.)

Configure a sua Evolution API para enviar callbacks para esse endpoint. Nesta versão, o plugin registra o payload em log (para diagnóstico). Em versões futuras, esses eventos poderão alimentar as estatísticas de mensagens no Mautic.

## Como usar (desenvolvedores)
Você pode utilizar o serviço de envio diretamente em código (por exemplo, em um plugin/integração customizada dentro do Mautic). Exemplos em PHP:

- Enviar texto:

  $sender = $container->get(\MauticPlugin\MauticEvolutionApiBundle\Service\WhatsAppSender::class);
  $sender->sendText('+5511999999999', 'Olá do Mautic!');

- Enviar imagem por URL (com legenda opcional):

  $sender->sendImageUrl('+5511999999999', 'https://seu-mautic.tld/media/minha-imagem.jpg', 'Legenda opcional');

- Enviar vídeo por URL (com legenda opcional):

  $sender->sendVideoUrl('+5511999999999', 'https://seu-mautic.tld/media/meu-video.mp4', 'Assista!');

Observações importantes:
- O número de destino deve estar em formato E.164 (ex.: +5511999999999).
- Para imagens/vídeos, forneça uma URL acessível publicamente pela Evolution API.

## Teste rápido
1. Após configurar o plugin, acione um envio de teste via container (ex.: em um comando custom do Symfony ou controller interno) usando os exemplos do tópico anterior.
2. Verifique no log do seu servidor e/ou nos logs do Mautic se houve algum erro.
3. Caso tenha configurado o webhook, envie uma mensagem real e valide se os callbacks estão chegando (o plugin responderá “ok” e registrará o payload em log).

## Solução de problemas
- Plugin não aparece na lista:
  - Confirme o caminho: plugins/MauticEvolutionApiBundle
  - Rode: php bin/console mautic:plugins:reload
  - Limpe cache: php bin/console cache:clear
- Erro de autenticação na Evolution API:
  - Revise api_url, api_key e instance_id em Configurações do Plugin.
  - Verifique se o API URL está correto (sem barra no final é o mais seguro; o plugin lida com ambos os casos, mas a consistência ajuda).
- Imagem/Vídeo não enviados:
  - Garanta que a URL do arquivo é publicamente acessível para a Evolution API.
- Webhook não recebe callbacks:
  - Verifique se a Evolution API está apontando para https://SEU-MAUTIC/evolution/webhook
  - Confirme que o servidor do Mautic é acessível externamente e que não há bloqueios de firewall.

## Roadmap (próximas melhorias)
- Registro do WhatsApp como Canal de Mensagens dentro do Mautic (transport/adapter dedicado)
- Associação dos status de leitura/entrega às estatísticas de mensagens
- Seleção de Assets do Mautic diretamente ao compor mensagens

## Licença
Consulte a licença do projeto ou da sua instância. Este plugin segue a compatibilidade com a licença do Mautic para integrações.
