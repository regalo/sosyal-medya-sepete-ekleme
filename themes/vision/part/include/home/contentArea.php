<script>
function gizleGoster(ID) {
  var secilenID = document.getElementById("acKapa");
  if (secilenID.style.display == "none") {
    secilenID.style.display = "";
    document.getElementById("tkapat").style.display = "none";
    document.getElementById("tgoster").style.display = "block";
  } else {
    secilenID.style.display = "none";
	document.getElementById("tgoster").style.display = "none";
	document.getElementById("tkapat").style.display = "block";
  }
}
</script>
<section class="contentArea wow fadeInUp">
	<div style="display:none;" id="acKapa" class="container mp0">
		<?php echo $value["content"];?>
	</div>
</section>
<div class="whyListMore"><button onclick="gizleGoster();" class="whymore anibut"><span id="tgoster">Tümünü Göster <i class="fas fa-arrow-down" aria-hidden="true"></i></span><span style="display:none;" id="tkapat">Tümünü Gizle <i class="fas fa-arrow-up" aria-hidden="true"></i></span></button> </div>