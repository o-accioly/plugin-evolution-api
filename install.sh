#!/bin/bash

# Script para limpar cache do Mautic e verificar plugin

MAUTIC_DIR="/home/accioly/Downloads/mautic-5.0"

echo "=== Limpando cache do Mautic ==="
cd "$MAUTIC_DIR"

# Remove cache directories
rm -rf var/cache/*
echo "Cache removido"

# Se PHP estiver disponível, execute os comandos do Mautic
if command -v php &> /dev/null; then
    echo "=== Executando comandos Mautic ==="
    php bin/console cache:clear --env=prod
    php bin/console cache:warmup --env=prod
    php bin/console mautic:plugins:reload
    echo "Cache recriado e plugins recarregados"
else
    echo "PHP não encontrado. Execute manualmente:"
    echo "php bin/console cache:clear --env=prod"
    echo "php bin/console cache:warmup --env=prod" 
    echo "php bin/console mautic:plugins:reload"
fi

echo "=== Verificando estrutura do plugin ==="
if [ -d "plugins/MauticEvolutionApiBundle" ]; then
    echo "✓ Plugin directory exists"
    
    if [ -f "plugins/MauticEvolutionApiBundle/MauticEvolutionApiBundle.php" ]; then
        echo "✓ Main plugin file exists"
    else
        echo "✗ Main plugin file missing"
    fi
    
    if [ -f "plugins/MauticEvolutionApiBundle/Config/config.php" ]; then
        echo "✓ Config file exists"
    else
        echo "✗ Config file missing"
    fi
    
    if [ -f "plugins/MauticEvolutionApiBundle/Integration/EvolutionApiIntegration.php" ]; then
        echo "✓ Integration file exists"
    else
        echo "✗ Integration file missing"
    fi
else
    echo "✗ Plugin directory not found"
fi

echo "=== Instruções ==="
echo "1. Acesse o Mautic via browser"
echo "2. Vá para Configurações > Plugins"
echo "3. Procure por 'WhatsApp Evolution API'"
echo "4. Se não aparecer, verifique os logs em var/logs/"
