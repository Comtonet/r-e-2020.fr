(function(){
'use strict';
const root=document.getElementById('devis-app');
if(!root)return;
let autoInit=false;
let explicitChoice=false;
let chosen='permis';
let delivery='standard';
let hasCalculated=false;
let calculating=false;
let tuneFrame=0;
let inputTimer=0;
const q=s=>root.querySelector(s);
const qa=s=>Array.from(root.querySelectorAll(s));
const parseEur=s=>{const n=String(s||'').replace(/\s/g,'').replace('€','').replace(',','.').replace(/[^0-9.\-]/g,'');return Number(n)||0};
const eur=n=>n.toLocaleString('fr-FR',{minimumFractionDigits:2,maximumFractionDigits:2})+' €';

function scheduleTune(delay=0){
  clearTimeout(inputTimer);
  const run=()=>{
    cancelAnimationFrame(tuneFrame);
    tuneFrame=requestAnimationFrame(tune);
  };
  if(delay) inputTimer=setTimeout(run,delay); else run();
}

function ensureLoader(){
  if(q('.quote-loader'))return;
  const loader=document.createElement('div');
  loader.className='quote-loader';
  loader.setAttribute('aria-hidden','true');
  loader.innerHTML=`<div class="quote-loader-card"><div class="quote-infinity" aria-hidden="true"><i></i><i></i></div><strong>Calcul de votre devis</strong><span>Calcul en cours à partir des informations renseignées…</span><div class="quote-loader-line"><b></b></div></div>`;
  root.appendChild(loader);
}

function showLoader(){
  ensureLoader();
  calculating=true;
  const loader=q('.quote-loader');
  if(loader){loader.classList.add('show');loader.setAttribute('aria-hidden','false')}
  root.classList.add('is-calculating');
}

function hideLoader(){
  calculating=false;
  const loader=q('.quote-loader');
  if(loader){loader.classList.remove('show');loader.setAttribute('aria-hidden','true')}
  root.classList.remove('is-calculating');
}

function ensureDefault(){
  if(autoInit)return;
  const b=q('[data-act="prestation"][data-id="permis"]');
  if(!b)return;
  autoInit=true;
  if(b.getAttribute('aria-pressed')!=='true') b.click();
}

function addProgress(){
  const screen=q('#quoteScreen');
  if(!screen)return;
  let progress=screen.querySelector('.quote-progress-lite');
  const onHome=!!screen.querySelector('.planche');
  const onEntry=!!screen.querySelector('.lot');
  const onDoc=!!screen.querySelector('.doc');
  if(!onHome&&!onEntry&&!onDoc)return;
  const step=onHome?1:onEntry?2:3;
  if(!progress){
    progress=document.createElement('div');
    progress.className='quote-progress-lite';
    screen.prepend(progress);
  }
  progress.innerHTML=`<div class="quote-progress-track"><i style="width:${step/3*100}%"></i></div><div class="quote-progress-labels"><span class="${step>=1?'on':''}">Projet</span><span class="${step>=2?'on':''}">Informations</span><span class="${step>=3?'on':''}">Devis</span></div>`;
}

function lightenHome(){
  const screen=q('#quoteScreen');
  if(!screen||!screen.querySelector('.planche'))return false;
  const blocks=Array.from(screen.querySelectorAll('.block'));
  if(blocks[0]&&blocks[0].querySelector('[data-act="prestation"]')) blocks[0].remove();
  const left=Array.from(screen.querySelectorAll('.block'));
  if(left[0]){const h=left[0].querySelector('h2');if(h)h.textContent='1. Quelle est la nature de l’opération ?'}
  if(left[1]){const h=left[1].querySelector('h2');if(h)h.textContent='2. Quel type de bâtiment concerne l’opération ?'}
  qa('.planche .tiles').forEach(tiles=>{
    const all=Array.from(tiles.querySelectorAll('.tile'));
    all.slice(1).forEach(x=>x.remove());
    tiles.classList.add('tiles-lite');
  });
  const lead=screen.querySelector('.hero .lede');
  if(lead)lead.textContent='Décrivez votre projet en quelques clics. Vous pourrez ensuite choisir le niveau d’étude souhaité.';
  return true;
}

function prices(){
  const m=qa('#quoteRail .money .amt');
  return {permis:parseEur(m[0]?.textContent),fdc:parseEur(m[1]?.textContent),complete:parseEur(m[2]?.textContent)};
}

function tuneSaisieText(){
  const screen=q('#quoteScreen');
  if(!screen||!screen.querySelector('.lot'))return;
  const lead=screen.querySelector('.hero .lede');
  if(lead)lead.textContent='Renseignez les informations concernant votre projet. Les tarifs seront affichés uniquement à la fin.';
}

function enhanceFields(){
  qa('.lot input,.lot select').forEach(el=>{
    if(el.dataset.quoteEnhanced)return;
    el.dataset.quoteEnhanced='1';
    const wrap=el.closest('.field,.f,.row')||el.parentElement;
    if(wrap)wrap.classList.add('quote-field-enhanced');
  });
}

function standardDelayDays(ttc){
  const ht=(Number(ttc)||0)/1.2;
  if(ht<=200)return 1;
  if(ht>=1000)return 5;
  return Math.ceil(1+((ht-200)/800)*4);
}
function currentBaseTtc(){
  const p=prices();
  return chosen==='complete'?p.complete:p.permis;
}
function expressAvailable(){return standardDelayDays(currentBaseTtc())>1}
function expressSurchargeTtc(){return Math.round(currentBaseTtc()*.10*100)/100}
function currentTotalTtc(){return currentBaseTtc()+(delivery==='express'&&expressAvailable()?expressSurchargeTtc():0)}
function finalDelay(){return delivery==='express'&&expressAvailable()?1:standardDelayDays(currentBaseTtc())}

function addFinalChoice(){
  const screen=q('#quoteScreen');
  if(!screen||!screen.querySelector('.lot'))return false;
  let box=screen.querySelector('.final-prestation-lite');
  if(!box){box=document.createElement('section');box.className='panel final-prestation-lite';screen.appendChild(box)}
  const next=q('#quoteNext');
  const txt=q('#quoteBarTxt');
  if(!hasCalculated){
    box.innerHTML=`<div class="quote-final-head"><div><span class="chip o">Dernière étape</span><h3>Votre projet est prêt</h3><p>Lancez le calcul pour afficher les deux niveaux d’étude disponibles.</p></div><span class="quote-final-step">3/3</span></div><button type="button" class="btn btn-p quote-calculate-btn" data-act="calculate-quote"><span>Calculer mon devis</span><b aria-hidden="true">→</b></button><div class="quote-calc-note"><span>✓ Calcul immédiat</span><span>✓ Sans engagement</span></div>`;
    if(next){next.disabled=true;next.textContent='Calculez d’abord votre devis'}
    if(txt)txt.textContent='Terminez votre saisie puis calculez votre devis.';
    return true;
  }
  const p=prices();
  const selected=explicitChoice;
  const delay=selected?standardDelayDays(currentBaseTtc()):0;
  if(delay<=1)delivery='standard';
  box.innerHTML=`<div class="quote-final-head"><div><span class="chip g">Votre devis</span><h3>Choisissez votre niveau d’étude</h3><p>Les tarifs affichés sont TTC. KeePlanet vérifiera le devis avant le démarrage de l’étude.</p></div><span class="quote-final-step done">✓</span></div>
  <div class="opts final-presta-grid quote-two-offers">
    <button class="opt quote-offer" data-act="prestation" data-id="permis" aria-pressed="${explicitChoice&&chosen==='permis'}"><span class="tick"></span><span><strong>BBIO</strong><small>BBIO + DH et éléments nécessaires au dépôt du permis.</small><em>${eur(p.permis)}</em><i>Sélectionner ce pack</i></span></button>
    <button class="opt quote-offer quote-offer-mid" data-act="prestation" data-id="complete" aria-pressed="${explicitChoice&&chosen==='complete'}"><span class="quote-badge">Le plus choisi</span><span class="tick"></span><span><strong>Étude complète</strong><small>BBIO, Cep, Cep,nr, DH, ACV et livrables nécessaires.</small><em>${eur(p.complete)}</em><i>Sélectionner ce pack</i></span></button>
  </div>
  ${selected?`<div class="quote-public-delay"><div class="quote-public-delay-head"><strong>Délai de réalisation</strong><span>Choisissez le délai souhaité.</span></div><div class="quote-public-delay-grid"><button type="button" class="quote-delay-btn ${delivery==='standard'?'on':''}" data-quote-delivery="standard"><b>Standard</b><small>${delay} jour${delay>1?'s':''} ouvré${delay>1?'s':''}</small></button>${delay>1?`<button type="button" class="quote-delay-btn express ${delivery==='express'?'on':''}" data-quote-delivery="express"><b>Express</b><small>1 jour ouvré · +${eur(expressSurchargeTtc())} TTC</small></button>`:''}</div></div>
  <button type="button" class="btn btn-p quote-send-btn" data-open-public-signup>Recevoir mon devis et créer mon compte gratuitement</button>
  <p class="quote-account-note">Aucun paiement à cette étape. Le devis sera envoyé par e-mail et restera disponible depuis votre espace client.</p>`:''}`;
  if(next){
    next.hidden=!!explicitChoice;
    next.disabled=!explicitChoice;
    next.textContent='Choisissez votre pack';
  }
  if(txt)txt.innerHTML=explicitChoice?`Votre devis : <b>${eur(currentTotalTtc())} TTC</b> · délai <b>${finalDelay()} jour${finalDelay()>1?'s':''} ouvré${finalDelay()>1?'s':''}</b>`:'Sélectionnez un pack pour continuer.';
  return true;
}

function publicPayload(){
  const engine=window.KP_QUOTE_ENGINE;
  const st=engine&&engine.getState?engine.getState():null;
  if(!st)return null;
  const famMap={maisons:'maison',collectif:'collectif',tertiaire:'tertiaire',mixte:'mixte'};
  const natMap={neuf:'construction',ext:'extension',sur:'surelevation','mixte-ne':'mixte','reno-ext':'extension','reno-neuf':'mixte'};
  const family=famMap[st.famille]||st.famille||'';
  const nature=natMap[st.nature]||st.nature||'';
  const data={projectName:st.nom||''};
  if(family==='maison'){
    const mi=(st.lots||[]).find(l=>l.usage==='MI');
    const ext=(st.lots||[]).find(l=>l.usage==='EXT');
    data.N=mi&&mi.v?mi.v.N:'';
    data.M=mi&&mi.v?mi.v.M:'';
    if(ext&&ext.v)data.extensionSurface=ext.v.S||'';
  }else if(family==='collectif'){
    const col=(st.lots||[]).find(l=>l.usage==='COL');
    const bats=col&&col.v&&Array.isArray(col.v.bats)?col.v.bats:[];
    data.buildings=bats.map(b=>b&&typeof b==='object'?{n:b.n,same:b.same==null?'':b.same}:{n:b,same:''});
  }else{
    data.zones=(st.lots||[]).map(l=>({usage:l.usage||'',surface:l.v&&l.v.S!=null?l.v.S:'',count:l.v&&l.v.n!=null?l.v.n:'',resto:l.v&&l.v.resto||'',amphi:l.v&&l.v.amphi||'',cuisine:l.v&&l.v.cuisine||'',lits:l.v&&l.v.lits||'',sc:l.v&&l.v.sc||'',sj:l.v&&l.v.sj||'',coqueBrute:l.v&&l.v.coqueBrute||'',surfExist:l.v&&l.v.surfExist||''}));
  }
  const p=prices();
  const totalTtc=currentTotalTtc();
  return {
    version:'site-public-v1',
    origine:'r-e-2020.fr',
    reference:st.ref||'',
    date:new Date().toISOString(),
    projet:{nature,famille:family,usage:null,donnees:data},
    reglementation:'RE2020',
    prestation:chosen==='complete'?'complete':'bbio',
    delai:{mode:delivery,jours_ouvres:finalDelay(),express:delivery==='express'&&expressAvailable(),surcout_ttc:delivery==='express'&&expressAvailable()?expressSurchargeTtc():0},
    prix:{bbio_ttc:p.permis,complete_ttc:p.complete,total_ttc:totalTtc,total_ht:totalTtc/1.2}
  };
}

function removeStrayPrices(){
  if(hasCalculated)return;
  qa('#quoteScreen .money,#quoteScreen .price,#quoteScreen .prix,#quoteScreen [class*="price"],#quoteScreen [class*="prix"]').forEach(el=>el.style.display='none');
}

function tune(){
  ensureLoader();
  ensureDefault();
  lightenHome();
  tuneSaisieText();
  enhanceFields();
  addFinalChoice();
  removeStrayPrices();
  addProgress();
  root.classList.add('devis-lite-site');
}

root.addEventListener('click',e=>{
  const signupBtn=e.target.closest('[data-open-public-signup]');
  if(signupBtn){
    e.preventDefault();
    e.stopPropagation();
    const payload=publicPayload();
    if(!payload)return;
    const choice=chosen==='complete'?'Étude complète RE2020':'BBIO RE2020';
    document.dispatchEvent(new CustomEvent('re2020:open-signup',{detail:{payload,choice}}));
    return;
  }
  if(e.target.closest('select,input,textarea'))return;
  const delayBtn=e.target.closest('[data-quote-delivery]');
  if(delayBtn){
    if(calculating)return;
    e.preventDefault();
    delivery=delayBtn.dataset.quoteDelivery==='express'?'express':'standard';
    scheduleTune();
    return;
  }
  const b=e.target.closest('[data-act]');
  if(!b||calculating)return;
  if(b.dataset.act==='calculate-quote'){
    e.preventDefault();
    e.stopPropagation();
    showLoader();
    explicitChoice=false;
    chosen='permis';
    delivery='standard';
    hasCalculated=true;
    scheduleTune();
    setTimeout(()=>{
      hideLoader();
      const box=q('.final-prestation-lite');
      if(box)box.scrollIntoView({behavior:'smooth',block:'center'});
    },420);
    return;
  }
  if(b.dataset.act==='prestation'&&b.closest('.final-prestation-lite')){explicitChoice=true;chosen=b.dataset.id;delivery='standard'}
  if(b.dataset.act==='nature'||b.dataset.act==='famille'){hasCalculated=false;explicitChoice=false;chosen='permis';delivery='standard'}
  scheduleTune();
});

root.addEventListener('input',e=>{
  if(e.target.closest('[data-quote-account-form]'))return;
  if(e.target.closest('.lot')){
    hasCalculated=false;
    explicitChoice=false;
    chosen='permis';
    delivery='standard';
    scheduleTune(90);
  }
});
root.addEventListener('change',e=>{
  if(e.target.closest('[data-quote-account-form]'))return;
  if(e.target.closest('.lot')){
    hasCalculated=false;
    explicitChoice=false;
    chosen='permis';
    delivery='standard';
    scheduleTune();
  }
});

q('#quoteNext')?.addEventListener('click',e=>{
  const st=window.KP_QUOTE_ENGINE&&window.KP_QUOTE_ENGINE.getState?window.KP_QUOTE_ENGINE.getState():null;
  if(st&&st.ecran==='saisie'){
    e.preventDefault();
    e.stopImmediatePropagation();
    const box=q('.final-prestation-lite');
    if(box)box.scrollIntoView({behavior:'smooth',block:'center'});
    return;
  }
  scheduleTune();
},true);
q('#quoteBack')?.addEventListener('click',()=>scheduleTune());
scheduleTune();
})();