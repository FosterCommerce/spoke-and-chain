<?php

/**
 * Variant Manager config.php
 *
 * This file exists only as a template for the Variant Manager settings.
 * It does nothing on its own.
 *
 * Don't edit this file, instead copy it to 'craft/config' as 'variant-manager.php'
 * and make your changes there to override default settings.
 *
 * Once copied to 'craft/config', this file will be multi-environment aware as
 * well, so you can have different settings groups for each environment, just as
 * you do for 'general.php'
 */

return [
	'emptyAttributeValue' => '',
	'attributePrefix' => 'Attribute: ',
	'inventoryPrefix' => 'Inventory: ',
	'activityLogRetention' => '30 days',
	'productFieldMap' => [
		'*' => [
			'title' => 'title',
			'slug' => 'slug',
			'body' => 'body',
		],
	],
	'variantFieldMap' => [
		'*' => [
			'title' => 'title',
			'sku' => 'sku',
			'inventoryTracked' => 'inventoryTracked',
			'availableForPurchase' => 'availableForPurchase',
			'price' => 'basePrice',
			'promotable' => 'promotable',
		],
	],
];
