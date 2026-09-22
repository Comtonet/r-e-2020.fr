<?php
$packs = house_signup_packs();
$packSlug = trim((string)($_GET['pack'] ?? ''));
$pack = house_signup_pack($packSlug);
$offer = max(0, min(100, (int)($_GET['offre'] ?? 0)));
?>
<section class="house-signup">
  <div class="container signup-shell">
    <div class="signup-head">
      <span class="eyebrow">Espace client KeePlanet</span>
      <h1><?= $pack ? 'Ouvrez votre dossier RE2020' : 'Choisissez votre pack maison' ?></h1>
      <p><?= $pack ? 'Quelques informations suffisent pour créer votre dossier et accéder à votre espace client sécurisé.' : 'Sélectionnez la prestation souhaitée. Vous renseignerez ensuite vos coordonnées pour ouvrir votre dossier.' ?></p>
    </div>

    <?php if (!$pack): ?>
      <?php if ($offer > 0): ?>
        <div class="offer-note">Votre offre de -<?= h($offer) ?> % sera rattachée à votre inscription. Pack Eco'Permis exclu.</div>
      <?php endif; ?>
      <div class="signup-grid">
        <?php foreach ($packs as $slug => $item): ?>
          <?php if ($offer > 0 && $slug === 'eco') continue; ?>
          <a class="signup-pack" data-no-signup-popup href="/inscription-maison/?pack=<?= rawurlencode($slug) ?><?= $offer > 0 ? '&offre=' . (int)$offer : '' ?>">
            <strong><?= h($item['label'] ?? $slug) ?></strong>
            <span><?= h($item['description'] ?? '') ?></span>
            <b><?= h(house_signup_price_label($item)) ?></b>
          </a>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="signup-card">
        <?php if ($offer > 0 && $packSlug !== 'eco'): ?>
          <div class="offer-note">Offre de -<?= h($offer) ?> % rattachée à cette inscription.</div>
        <?php endif; ?>

        <div class="selected-pack">
          <div>
            <strong><?= h($pack['label'] ?? '') ?></strong>
            <span><?= h($pack['description'] ?? '') ?></span>
          </div>
          <b><?= h(house_signup_price_label($pack)) ?></b>
        </div>

        <a class="change-pack" data-no-signup-popup href="/inscription-maison/<?= $offer > 0 ? '?offre=' . (int)$offer : '' ?>">← Changer de pack</a>

        <form method="post" action="/inscription-maison/envoi/" data-house-signup-form>
          <input type="hidden" name="pack" value="<?= h($packSlug) ?>">
          <input type="hidden" name="offre_maison" value="<?= (int)$offer ?>">
          <input type="hidden" name="retour_site" value="" data-return-site>

          <div class="signup-form-grid">
            <label>
              <span>Nom et prénom *</span>
              <input type="text" name="nom" autocomplete="name" required>
            </label>
            <label>
              <span>Société <small>(facultatif)</small></span>
              <input type="text" name="societe" autocomplete="organization">
            </label>
            <label>
              <span>E-mail *</span>
              <input type="email" name="email" autocomplete="email" required>
            </label>
            <label>
              <span>Téléphone <small>(facultatif)</small></span>
              <input type="tel" name="telephone" autocomplete="tel">
            </label>
            <label class="wide">
              <span>Adresse *</span>
              <div class="address-wrap">
                <input type="text" name="adresse" autocomplete="off" aria-autocomplete="list" aria-expanded="false" data-house-address required>
                <div class="address-suggestions" data-house-address-suggestions hidden></div>
              </div>
            </label>
            <label>
              <span>Code postal *</span>
              <input type="text" name="code_postal" inputmode="numeric" autocomplete="postal-code" required>
            </label>
            <label>
              <span>Ville *</span>
              <input type="text" name="ville" autocomplete="address-level2" required>
            </label>
          </div>

          <button type="submit" class="btn btn-p signup-submit" data-no-signup-popup>Créer mon compte et ouvrir mon dossier</button>
          <p class="signup-note">Aucun paiement à cette étape. Si votre e-mail est déjà rattaché à un compte KeePlanet, nous ne vous connecterons pas automatiquement à ce compte.</p>
        </form>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php if ($pack): ?>
<script>
(function(){
  var form=document.querySelector('[data-house-signup-form]');
  if(!form)return;
  var ret=form.querySelector('[data-return-site]');
  if(ret)ret.value=window.location.origin;

  var input=form.querySelector('[data-house-address]');
  var list=form.querySelector('[data-house-address-suggestions]');
  var timer=0, controller=null, rows=[];

  function esc(s){return String(s||'').replace(/[&<>"']/g,function(ch){return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[ch]})}
  function close(){if(list){list.hidden=true;list.innerHTML=''}if(input)input.setAttribute('aria-expanded','false')}
  function street(r){
    var full=String(r.fulltext||r.label||r.street||'').trim();
    var zip=String(r.zipcode||((r.zipcodes||[])[0])||'').trim();
    var city=String(r.city||'').trim();
    var suffix=zip&&city?', '+zip+' '+city:'';
    if(suffix&&full.toLowerCase().endsWith(suffix.toLowerCase()))return full.slice(0,-suffix.length).trim();
    return full;
  }
  if(input){
    input.addEventListener('input',function(){
      clearTimeout(timer);
      if(controller){controller.abort();controller=null}
      var q=input.value.trim();
      if(q.length<3){close();return}
      timer=setTimeout(async function(){
        controller=new AbortController();
        try{
          var url='https://data.geopf.fr/geocodage/completion/?text='+encodeURIComponent(q)+'&type=StreetAddress&maximumResponses=6';
          var response=await fetch(url,{signal:controller.signal,headers:{Accept:'application/json'}});
          if(!response.ok)throw new Error('address');
          var data=await response.json();
          rows=data&&Array.isArray(data.results)?data.results.slice(0,6):[];
          if(!rows.length){close();return}
          list.innerHTML=rows.map(function(r,i){return '<button type="button" data-address-index="'+i+'">'+esc(r.fulltext||r.label||r.street||'')+'</button>'}).join('');
          list.hidden=false;
          input.setAttribute('aria-expanded','true');
        }catch(err){if(!err||err.name!=='AbortError')close()}
      },280);
    });

    list.addEventListener('click',function(e){
      var b=e.target.closest('[data-address-index]');
      if(!b)return;
      var r=rows[Number(b.getAttribute('data-address-index'))];
      if(!r)return;
      input.value=street(r);
      var zip=form.querySelector('[name="code_postal"]');
      var city=form.querySelector('[name="ville"]');
      if(zip)zip.value=String(r.zipcode||((r.zipcodes||[])[0])||'');
      if(city)city.value=String(r.city||'');
      close();
    });

    document.addEventListener('click',function(e){if(!e.target.closest('.address-wrap'))close()});
  }
})();
</script>
<?php endif; ?>
