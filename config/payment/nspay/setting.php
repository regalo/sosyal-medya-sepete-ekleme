<div class="tab-pane fade <?php if(ns_filter($method)=="nspay") { echo "active show";}?>" id="pills-<?php echo $value["folder"].'-'.$method;?>" role="tabpanel" aria-labelledby="pills-<?php echo $value["folder"].'-'.$method;?>-tab">
    <div class="animated fadeIn" id="scrolling">
        <div class="orders">
            <div class="card-header mt-4">
                <strong class="box-title">Banka Hesapları</strong>
                <a href="<?php echo $ayar->getpage('odeme-ayarlari','banka-ekle');?>" class="butto butto-dark butto-xs butbor pull-right"><i class="fas fa-plus"></i> Hesap Ekle</a>
            </div>
            <div class="table-stats order-table ov-h">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Banka Adı</th>
                            <th>Alıcı</th>
                            <th>IBAN</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($ayar->all('havalebank') as $bnk) {
                        extract($bnk);
                        $info = explode('NivuBol', $item3); ?>
                        <tr>
                            <td><?php echo $item2;?></td>
                            <td><?php echo $item4;?></td>
                            <td style="min-width: 250px"><?php echo $info[0];?></td>
                            <td style="min-width: 150px" class="text-right">
                                <a href="<?php echo $ayar->getpage('odeme-ayarlari',$ayar_1);?>" class="butto butto-primary butto-xs butbor"><i class="fas fa-cog"></i> Düzenle</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="clear"></div>
            </div>
            <div class="alert alert-danger form-group col-md-12">
                <p class="mb-0">Scriptin sunduğu EFT-Havale yöntemini aktifleştirmek için banka hesaplarını girin ve değişiklikleri kaydedin.</p>
            </div>
            <div class="col-md-12 text-right mt-3">
                <form id="nivusoft-havale" method="POST" action="" onsubmit="fastpost('nivusoft-havale','ajaxout'); return false;">
                    <input type="hidden" name="page" value="odeme-ayarlari">
                    <input type="hidden" id="olay" name="olay" value="havalepay">
                    <input type="hidden" name="item2" value="nspay">
                    <input type="hidden" name="item3" value="">
                    <input type="hidden" name="item4" value="">
                    <input type="hidden" name="item5" value="">
                    <input type="hidden" name="statu" value="1">
                    <button  type="submit" class="butto butto-success butto-lg butbor pull-right mt-3"><i class="fas fa-check"></i> Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>