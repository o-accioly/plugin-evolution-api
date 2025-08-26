<?php
// Script para limpar qualquer instalação anterior do plugin
// Execute este script antes de recarregar os plugins

$container = $this->container ?? $kernel->getContainer();
$em = $container->get('doctrine.orm.entity_manager');

// Remove any existing plugin records
$qb = $em->createQueryBuilder();
$qb->delete('MauticPluginBundle:Plugin', 'p')
   ->where('p.bundle = :bundle')
   ->setParameter('bundle', 'MauticEvolutionApiBundle');

$qb->getQuery()->execute();

echo "Plugin records cleaned.\n";
