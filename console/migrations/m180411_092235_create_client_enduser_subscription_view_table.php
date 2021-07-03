<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news_rtv_metadata`.
 */
class m180411_092235_create_client_enduser_subscription_view_table extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {

        $query = ' CREATE VIEW `client_enduser_subscription_view` AS SELECT ' .
                '   subscription.id,  ' .
                '   subscription.`service_type`, ' .
                '   enduser_subscription.enduser_id, ' .
                '   subscription.country_id, ' .
                '   subscription.`category_id`, ' .
                '   category.name as category_name, ' .
                '   subscription.`subcategory_id`,  ' .
                '   sub_category.name as subcategory_name,  ' .
                '   subscription.`brand_id`, ' .
                '   brands.name as brand_name,  ' .
                '   brands.logo as brand_logo, ' .
                '   subscription_tag.tag, ' .
                '   subscription_competitor.competitor_id, ' .
                '   competitor.name as competitor_name, ' .
                '   subscription.status, ' .
                '   subscription.start_dt, ' .
                '   subscription.end_dt ' .
                'FROM `enduser_subscription`  ' .
                'INNER JOIN `subscription` ON `subscription`.id = `enduser_subscription`.`subscription_id`  ' .
                'INNER JOIN `subscription_tag` ON `subscription_tag`.`subscription_id` = `subscription`.`id`  ' .
                'INNER JOIN`subscription_competitor` ON`subscription_competitor`.`subscription_id` = `subscription`.`id` ' .
                'INNER JOIN brands as competitor on competitor.id = subscription_competitor.competitor_id ' .
                'INNER JOIN category on category.category_id = subscription.category_id ' .
                'INNER JOIN sub_category on sub_category.id =subscription.subcategory_id ' .
                'INNER JOIN brands on brands.id =subscription.brand_id ';
        $this->execute($query);
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->execute("DROP VIEW IF EXISTS client_enduser_subscription_view");
    }

}
