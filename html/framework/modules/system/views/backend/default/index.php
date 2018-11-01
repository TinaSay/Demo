<?php

/* @var $this yii\web\View */

use krok\paperDashboard\widgets\analytics\AnalyticsWidget;
use krok\paperDashboard\widgets\analytics\SpaceCircleChartWidget;

$this->title = 'Администрирование';
?>
<div class="row">
    <div class="style-card">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-user-hello">
                        <div class="card-header">
                            <div class="card-header__inner">
                                <i class="card-user-hello__icon"></i>
                                <h4 class="card-title">Добро пожаловать!</h4>
                                <p class="category">Вы авторизовались, как <a href="#">webmaster</a></p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <p class="category">
                                <i class="ti-time"></i>Ваше последнее посещение панели администратора:
                                <span>23.07.2017 в 17:56</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="two-card-info">
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Общие характеристики системы</h4>
                            </div>
                            <div class="card-content">
                                <ul class="system-info-list">
                                    <li>
                                        <?= AnalyticsWidget::widget(['name' => 'os/version', 'constructor' => ['s']]) ?>
                                    </li>
                                    <li>
                                        <?= AnalyticsWidget::widget(['name' => 'database/info']) ?>
                                    </li>
                                    <li>
                                        <?= AnalyticsWidget::widget(['name' => 'php/version']) ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <?= SpaceCircleChartWidget::widget() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
