<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="panel_s">
	<div class="panel-body">
		<?php
		//pofa 2020-09-16: start custom code to set permissions
		$articles1=$articles;
		$articles=array();
		foreach($articles1 as $k => $v){
			if ($v["group_slug"]==="public") $articles[$k] = $v;
			if ($v["group_slug"]==="customer" .  $_SESSION["client_user_id"]) $articles[$k] = $v;
		}
		//echo "<textarea>"; var_dump($_SESSION); echo "</textarea>";
		//echo "<textarea>"; var_dump($articles1); echo "</textarea>";
		//pofa 2020-09-16: end custom code to set permissions
		?>

		<?php if(count($articles) == 0){ ?>
		<p class="no-margin"><?php echo _l('clients_knowledge_base_articles_not_found'); ?></p>
		<?php } ?>
		<?php if(isset($category)){
			// Category articles list
			get_template_part('knowledge_base/category_articles_list', array('articles'=>$articles));
		}  else if(isset($search_results)) {
			// Search results
			get_template_part('knowledge_base/search_results', array('articles'=>$articles));
		} else {
			// Default page
			get_template_part('knowledge_base/categories', array('articles'=>$articles));
		}
		hooks()->do_action('after_kb_groups_customers_area');
		?>
	</div>
</div>
