#!/bin/bash

# Script para limpar o plugin do banco de dados antes de recarregar

echo "Limpando registros do plugin MauticEvolutionApiBundle..."

# Conectar ao banco e limpar registros do plugin
mysql -u root -p mautic -e "DELETE FROM plugins WHERE bundle = 'MauticEvolutionApiBundle';"

echo "Registros limpos. Agora execute: php ../../bin/console mautic:plugins:reload"
