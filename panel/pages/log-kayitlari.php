<?php
?><div class="content" id="alan">
   <div class="animated fadeIn" id="scrolling">
      <div class="orders">
         <div class="row">
            <div class="col-lg-12">
               <div class="card" id="normalalan">
                  <div class="card-header">
                     <form method="get" action="<?php echo $ayar->getpage("log-kayitlari");?>">
                        <input type="hidden" name="include" value="completed"> 
                        <div class="row">
                           <div class="col-md-8 align-self-center"> <strong class="box-title">İşlem Logları</strong>
                              <?php if(isset($get["search"])) { ?>
                                 <a class="btn butto butto-light ml-3 btn-statu btn-xs" href="<?php echo $ayar->getpage("log-kayitlari");?>">Geri</a>
                              <?php } ?>
                           </div>
                           <div class="col-md-4">
                              <div class="bz-search position-relative">
                                 <input type="text" name="search" class="form-control w-100" placeholder="Log Ara (İşlem Türü, Kişi, IP vs.)" value="">
                                 <button type="submit" class="butto butto-dark butbor bz-search-button"><i class="fas fa-search" aria-hidden="true"></i> Ara</button>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="table-stats order-tumu order-table ov-h result-table" id="tb-scroll">
                     <table class="table orders-list " id="orders-list">
                        <thead>
                           <tr>
                              <th class="text-left" width="120">İşlem</th>
                              <th class="text-left">Olay</th>
                              <th class="text-right" width="450">Tarayıcı</th>
                              <th class="text-right" width="130">Ip</th>
                              <th class="text-right" width="150">Tarih</th>
                           </tr>
                        </thead>
                        <tbody>
                        	<?php foreach ($ns_log->all(0,10) as $value) {
                             $value["log_content"] = $ns_log->jsonData($value["log_content"]); ?>
                             <tr>
                              <td class="text-left" width="120"><a href="<?php echo $ns_log->href($value["log_type"],$value["log_content"]["string"]);?>" target="_blank" class="btn buttosi butto butto-<?php echo $ns_log->logType($value["log_type"])["class"];?> btn-statu btn-xs"><?php echo $ns_log->logType($value["log_type"])["name"];?></a></td>
                              <td class="text-left"><?php echo $value["log_content"]["text"];?></td>
                              <td class="text-right" width="450"><?php echo htmlentities($value["log_content"]["agent"]->user_agent);?></td>
                              <td class="text-right" width="130"><?php echo htmlentities($value["log_content"]["agent"]->ip);?></td>
                              <td class="text-right" width="150"><?php echo $value["log_time"];?></td>
                           </tr>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
               <?php if(!$ns_log->count>0) { ?>
                <div class="py-5 text-center">
                  <h4 class="font-weight-bold">Listelenecek Sonuç Bulunamadı!</h4>
                  <p>Aradığınız kelime için herhangi bir kayıt bulunamadı.</p>
                  <script type="text/javascript">$(".result-table").remove();</script>
               </div>
            <?php } ?>

            <?php if(count($ns_log->pagination)>0) { ?> 
             <div class="nexto">
                <ul class="pagination logpagi">
                   <?php foreach ($ns_log->pagination as $key => $value) { ?>
                     <li class="page-item"><a class="page-link <?php echo $value["active"] ? 'active':'';?>" href="<?php echo $value["href"];?>"><?php echo $value["text"];?></a></li>
                  <?php } ?>
               </ul>
            </div>
         <?php } ?>
      </div>
      <style type="text/css"> .text-limit { white-space: nowrap; overflow: hidden; border-right: 1px solid #e7e7e70f !important; } </style>
   </div>
</div>
</div>
</div>
</div>