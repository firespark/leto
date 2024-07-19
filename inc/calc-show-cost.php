                            <div class="calc-right__top">
                                <div class="calc-right__title">Расчет стоимости</div>
                                <div class="calc-right__block calc-right__block-1">
                                    <div class="calc-right__name">Транспорт</div>
                                    <div class="calc-right__content">
                                        <span>Грузоподъёмность: <span class="inSpan" id="rightLoadCapacity"></span></span>
                                        <span>Тип кузова: <span class="inSpan" id="rightBodyType"></span></span>
                                    </div>
                                </div>
                                <div class="calc-right__block calc-right__block-2">
                                    <div class="calc-right__name">Маршрут</div>
                                    <div class="calc-right__content">
                                        <span id="rightStartPoint">Адрес погрузки</span>
                                        <span id="rightEndPoint">Адрес разгрузки</span>
                                    </div>
                                </div>
                                <!--<div class="calc-right__block calc-right__block-3">
                                    <div class="calc-right__name">Время в пути</div>
                                    <div class="calc-right__content">
                                        <span>3 дня</span>
                                        <span>23.03.2023 - 26.03.2023</span>
                                    </div>
                                </div>
                                <div class="calc-right__block calc-right__block-4">
                                    <div class="calc-right__name">Расстояние</div>
                                    <div class="calc-right__content">
                                        <span>300 км</span>
                                    </div>
                                </div>-->
                            </div>
                            <div class="calc-right__image-ibg imgHidden">
                                <img src="<?php echo get_template_directory_uri();?>/img/calc-1.gif" alt="">
                            </div>
                            <div class="calc-right__price">
                                <div class="calc-right__pricename">Стоимость грузоперевозки*</div>
                                <div class="calc-right__priceprice"><span id="rightDeliveryCost">0</span> руб.</div>

                            </div>
                            <div class="calc-right__error">kkkkkk</div>
                            <div class="calc-right__info">*<?php echo $fieldsArr['calc_cost_notice'];?>
                            <?php if($fieldsArr['calc_cost_notice_notice']):?>
                            <span
                                    data-tippy-content="<?php echo $fieldsArr['calc_cost_notice_notice'];?>">!</span>
                            <?php endif;?>
                            </div>
                            <div class="calc-right__bottom">
                                <div class="calc-right__bottomimage-ibg">
                                    <img src="<?php echo get_template_directory_uri();?>/img/calc-2.png" alt="">
                                </div>
                                <div class="calc-right__bottomtext"><?php echo $fieldsArr['calc_cargo_notice'];?></div>
                            </div>