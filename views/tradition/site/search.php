<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/7
 * Time: 10:55
 * Email:liyongsheng@meicai.cn
 */

/* @var $this yii\web\View */
/** @var $dataProvider \yii\data\ActiveDataProvider */
use yii\grid\GridView;
use yii\bootstrap\Html;

$this->title = '搜索-'.$this->params['keyword'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-3">
                <?=\app\widgets\Category::widget(['type'=>\app\models\Content::TYPE_PRODUCTS,
                    'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue(Yii::$app->params,'themeColor')]
                ])?>
                <?=\app\widgets\LastNews::widget(['options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue(Yii::$app->params,'themeColor')]
                ])?>
                <?=\app\widgets\ConfigPanel::widget(['configName'=>'contact_us',
                    'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue(Yii::$app->params,'themeColor')]
                ])?>
            </div>
            <div class="col-lg-9">
                <div class="panel panel-default panel-<?=\yii\helpers\ArrayHelper::getValue(Yii::$app->params,'themeColor')?>">
                    <div class="panel-heading"><h3 class="panel-title">搜索-<?=$this->params['keyword']?></h3></div>
                </div>
                <div>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'tableOptions'=>['class'=>'table-simple'],
                        'showHeader'=>false,
                        'layout' => "{items}\n{pager}",
                        'columns' => [
                            [
                                'attribute'=>'title',
                                'format'=>'raw',
                                'value'=>function($item){
                                    $title = str_ireplace($this->params['keyword'],'<font color="#cc0000">'.$this->params['keyword'].'</font>',$item->title);
                                    if($item->type==\app\models\Content::TYPE_NEWS) {
                                        $html = Html::a($title, ['/news/', 'id' => $item->id],['target'=>'_blank']);
                                    }else{
                                        $html = Html::a($title, ['/products', 'id'=>$item->id],['target'=>'_blank']);
                                    }
                                    $html .='<p>'.str_ireplace($this->params['keyword'],'<font color="#cc0000">'.$this->params['keyword'].'</b>',$item->description).'</p>';
                                    return $html;
                                }
                            ],
                            [
                                'attribute'=>'create_at',
                                'format'=>'date',
                                'options'=>['class'=>'text-right','style'=>'width:100px']
                            ],
                        ],
                    ]); ?>
                </div>
            </div>

        </div>
    </div>
</div>