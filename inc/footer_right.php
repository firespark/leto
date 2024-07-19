
                    <div class="bottom-footer__right">
                        <?php if($optionsArr['main_footer_file1']):?>
                        <?php $file_check_ext1 = wp_check_filetype($optionsArr['main_footer_file1']['url']);?>
                        <a target="_blank" href="<?php echo $optionsArr['main_footer_file1']['url'];?>" class="bottom-footer__link"><span class="bottom-footer__linkdecor"><?php echo $file_check_ext1['ext'];?></span><span class="bottom-footer__linktext"><?php echo $optionsArr['main_footer_file1']['title'];?></span></a>
                        <?php endif;?>
                        <?php if($optionsArr['main_footer_file2']):?>
                        <?php $file_check_ext2 = wp_check_filetype($optionsArr['main_footer_file2']['url']);?>
                        <a target="_blank" class="bottom-footer__link" href="<?php echo $optionsArr['main_footer_file2']['url'];?>"><span class="bottom-footer__linkdecor"><?php echo $file_check_ext2['ext'];?></span><span class="bottom-footer__linktext"><?php echo $optionsArr['main_footer_file2']['title'];?></span></a>
                        <?php endif;?>
                    </div>