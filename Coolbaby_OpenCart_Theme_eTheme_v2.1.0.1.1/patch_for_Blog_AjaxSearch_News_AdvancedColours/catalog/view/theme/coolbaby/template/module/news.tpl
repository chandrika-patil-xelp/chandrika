            <div class="col-sm-3 col-md-2 hidden-xs">
                <div class="title upper"><i class="icon flaticon-news"></i><?php echo $heading_title; ?></div>
            </div>
            <div class="col-xs-5 col-sm-6 col-md-7 col-xs-push-1 col-sm-push-0">
                <div id="newsCarousel" class="slick-style1">
                    <?php foreach ($all_news as $news) : ?>

                    <div class="item upper">
                        <div class="marquee">
                            <span class="news_date"><?php echo $news['date_added']; ?></span>
                            <a href="<?php echo $news['view']; ?>"><?php echo $news['title']; ?></a>
                            <?php echo $news['description']; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>