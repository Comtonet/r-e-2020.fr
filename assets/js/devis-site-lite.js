(function(){
'use strict';
const root=document.getElementById('devis-app');
if(!root)return;
let autoInit=false;
let explicitChoice=false;
let chosen='permis';
let hasCalculated=false;
let calculating=false;
const q=s=>root.querySelector(s);
const qa=s=>Array.from(root.querySelectorAll(s));
const parseEur=s=>{const n=String(s||'').replace(/\s/g,'').replace('€','').replace(',','.').replace(/[^0-9.\-]/g,'');return Number(n)||0};
const eur=n=>n.toLocaleString('fr-FR',{minimumFractionDigits:2,maximumFractionDigits:2})+' €';

function ensureLoader(){
  if(q('.quote-loader'))return;
  const loader=document.createElement('div');
  loader.className='quote-loader';
  loader.setAttribute('aria-hidden','true');
  loader.innerHTML=`<div class="quote-loader-card"><div class="quote-infinity" aria-hidden="true"><i></i><i></i></div><strong>Calcul de votre devis</strong><span>Nous appliquons la grille correspondant à votre projet…</span></div>`;
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
  if(lead)lead.textContent='Décrivez simplement votre projet. À la fin, nous calculons instantanément les trois niveaux de prestation adaptés.';
  return true;
}

function prices(){
  const m=qa('#quoteRail .money .amt');
  return {permis:parseEur(m[0]?.textContent),fdc:parseEur(m[1]?.textContent),complete:parseEur(m[2]?.textContent)};
}

function syncCollectiveInlinePrice(){
  qa('.lot').forEach(lot=>{
    const rows=Array.from(lot.querySelectorAll('.rows .row:not(.head)'));
    if(rows.length!==1)return;
    const input=rows[0].querySelector('input[data-act="bat"]');
    if(!input)return;
    const footer=lot.querySelector('.lot-f span:first-child b');
    const inline=rows[0].querySelector('.val b');
    if(!footer||!inline)return;
    const total=parseEur(footer.textContent);
    if(total>0) inline.textContent=Math.round(total).toLocaleString('fr-FR')+' €';
  });
}

function hideLivePrices(){
  const rail=q('#quoteRail');
  if(!rail)return;
  rail.classList.toggle('quote-waiting-calc',!hasCalculated&&!!q('#quoteScreen .lot'));
}

function tuneSaisieText(){
  const screen=q('#quoteScreen');
  if(!screen||!screen.querySelector('.lot'))return;
  const lead=screen.querySelector('.hero .lede');
  if(lead)lead.textContent='Renseignez les caractéristiques utiles au chiffrage. Aucun prix ne s’affiche avant que vous lanciez le calcul.';
}

function addFinalChoice(){
  const screen=q('#quoteScreen');
  if(!screen||!screen.querySelector('.lot'))return false;
  let box=screen.querySelector('.final-prestation-lite');
  if(!box){
    box=document.createElement('section');
    box.className='panel final-prestation-lite';
    screen.appendChild(box);
  }

  const next=q('#quoteNext');
  const txt=q('#quoteBarTxt');

  if(!hasCalculated){
    box.innerHTML=`<div class="quote-final-head"><div><span class="chip o">Dernière étape</span><h3>Tout est renseigné ?</h3><p>Nous calculons les trois formules à partir des caractéristiques saisies.</p></div><span class="quote-final-step">3/3</span></div>
    <button type="button" class="btn btn-p quote-calculate-btn" data-act="calculate-quote"><span>Calculer mon devis</span><b aria-hidden="true">→</b></button>
    <div class="quote-calc-note">Calcul immédiat · sans engagement</div>`;
    if(next){next.disabled=true;next.textContent='Calculez d’abord votre devis'}
    if(txt)txt.textContent='Votre projet est prêt à être chiffré.';
    return true;
  }

  const p=prices();
  box.innerHTML=`<div class="quote-final-head"><div><span class="chip g">Votre estimation</span><h3>Choisissez votre niveau d’étude</h3><p>Les trois prix correspondent exactement au projet renseigné ci-dessus.</p></div><span class="quote-final-step done">✓</span></div>
  <div class="opts final-presta-grid">
    <button class="opt quote-offer" data-act="prestation" data-id="permis" aria-pressed="${explicitChoice&&chosen==='permis'}"><span class="tick"></span><span><strong>Bbio</strong><small>Bbio + DH et éléments nécessaires au dépôt du permis.</small><em>${eur(p.permis)}</em><i>Choisir Bbio</i></span></button>
    <button class="opt quote-offer quote-offer-mid" data-act="prestation" data-id="fdc" aria-pressed="${explicitChoice&&chosen==='fdc'}"><span class="quote-badge">Le plus choisi</span><span class="tick"></span><span><strong>Bbio + FDC</strong><small>Bbio + Cep, Cep,nr, DH et livrables nécessaires à la fin de travaux.</small><em>${eur(p.fdc)}</em><i>Choisir Bbio + FDC</i></span></button>
    <button class="opt quote-offer" data-act="prestation" data-id="complete" aria-pressed="${explicitChoice&&chosen==='complete'}"><span class="tick"></span><span><strong>La totale</strong><small>Bbio + FDC + ACV et tous les livrables de l’étude RE2020.</small><em>${eur(p.complete)}</em><i>Choisir la totale</i></span></button>
  </div>`;
  if(next){next.disabled=!explicitChoice;next.textContent=explicitChoice?'Voir mon devis':'Choisissez votre prestation'}
  if(txt&&!explicitChoice)txt.textContent='Sélectionnez la formule qui vous convient.';
  return true;
}

function addPermitInfo(){
  const screen=q('#quoteScreen');
  if(!screen||!screen.querySelector('.doc')||chosen!=='permis')return;
  if(screen.querySelector('.permit-info-lite'))return;
  const p=prices();
  const pay=screen.querySelector('.pay');
  if(!pay)return;
  const box=document.createElement('div');
  box.className='panel permit-info-lite';
  box.innerHTML=`<div class="panel-h"><span class="chip o">Évolutif</span><h3>Vous pourrez compléter l’étude plus tard</h3></div><div class="note info"><b>Bbio + FDC :</b> ${eur(p.fdc)} TTC<br><b>Bbio + FDC + ACV :</b> ${eur(p.complete)} TTC</div>`;
  pay.parentNode.insertBefore(box,pay);
}

function tune(){
  ensureLoader();
  ensureDefault();
  const onHome=lightenHome();
  tuneSaisieText();
  const onSaisie=addFinalChoice();
  if(!onHome&&!onSaisie)addPermitInfo();
  syncCollectiveInlinePrice();
  hideLivePrices();
  root.classList.add('devis-lite-site');
}

root.addEventListener('click',e=>{
  const b=e.target.closest('[data-act]');
  if(!b||calculating)return;
  if(b.dataset.act==='calculate-quote'){
    e.preventDefault();
    showLoader();
    explicitChoice=false;
    chosen='permis';
    setTimeout(()=>{
      hasCalculated=true;
      hideLoader();
      tune();
      const box=q('.final-prestation-lite');
      if(box)box.scrollIntoView({behavior:'smooth',block:'center'});
    },650);
    return;
  }
  if(b.dataset.act==='prestation'&&b.closest('.final-prestation-lite')){
    explicitChoice=true;
    chosen=b.dataset.id;
  }
  if(b.dataset.act==='nature'||b.dataset.act==='famille'){
    hasCalculated=false;
    explicitChoice=false;
    chosen='permis';
  }
  setTimeout(tune,0);
},true);
root.addEventListener('input',e=>{
  if(e.target.closest('.lot')){
    hasCalculated=false;
    explicitChoice=false;
    chosen='permis';
  }
  setTimeout(tune,0);
},true);
root.addEventListener('change',e=>{
  if(e.target.closest('.lot')){
    hasCalculated=false;
    explicitChoice=false;
    chosen='permis';
  }
  setTimeout(tune,0);
},true);
q('#quoteNext')?.addEventListener('click',()=>setTimeout(tune,0));
q('#quoteBack')?.addEventListener('click',()=>setTimeout(tune,0));
setTimeout(tune,0);
})();