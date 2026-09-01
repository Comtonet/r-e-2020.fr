(function(){
'use strict';
const root=document.getElementById('devis-app');
if(!root)return;
let autoInit=false;
let explicitChoice=false;
let chosen='permis';
let hasCalculated=false;
const q=s=>root.querySelector(s);
const qa=s=>Array.from(root.querySelectorAll(s));
const parseEur=s=>{const n=String(s||'').replace(/\s/g,'').replace('€','').replace(',','.').replace(/[^0-9.\-]/g,'');return Number(n)||0};
const eur=n=>n.toLocaleString('fr-FR',{minimumFractionDigits:2,maximumFractionDigits:2})+' €';

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
  if(lead)lead.textContent='Répondez simplement aux questions sur votre projet. Vous choisirez à la fin entre Bbio, Bbio + FDC ou l’étude totale avec ACV.';
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
  if(lead)lead.textContent='Renseignez les caractéristiques de votre projet. Le prix sera calculé uniquement lorsque vous aurez terminé la saisie.';
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
    box.innerHTML=`<div class="panel-h"><span class="chip o">Dernière étape</span><h3>Votre projet est renseigné ?</h3></div>
    <p class="hint">Une fois toutes les informations saisies, lancez le calcul pour obtenir les trois niveaux de prestation.</p>
    <button type="button" class="btn btn-p quote-calculate-btn" data-act="calculate-quote">Calculer mon devis</button>`;
    if(next){next.disabled=true;next.textContent='Calculez d’abord votre devis'}
    if(txt)txt.textContent='Terminez la saisie puis cliquez sur « Calculer mon devis ».';
    return true;
  }

  const p=prices();
  box.innerHTML=`<div class="panel-h"><span class="chip o">Votre devis</span><h3>Que souhaitez-vous commander ?</h3></div>
  <p class="hint">Choisissez le niveau d’étude adapté à votre besoin.</p>
  <div class="opts final-presta-grid">
    <button class="opt" data-act="prestation" data-id="permis" aria-pressed="${explicitChoice&&chosen==='permis'}"><span class="tick"></span><span><strong>Bbio</strong><small>Étude Bbio + DH et éléments nécessaires au dépôt du permis.</small><em>${eur(p.permis)}</em></span></button>
    <button class="opt" data-act="prestation" data-id="fdc" aria-pressed="${explicitChoice&&chosen==='fdc'}"><span class="tick"></span><span><strong>Bbio + FDC</strong><small>Bbio + Cep, Cep,nr, DH et livrables nécessaires à la fin de travaux.</small><em>${eur(p.fdc)}</em></span></button>
    <button class="opt" data-act="prestation" data-id="complete" aria-pressed="${explicitChoice&&chosen==='complete'}"><span class="tick"></span><span><strong>La totale</strong><small>Bbio + FDC + ACV et tous les livrables de l’étude RE2020.</small><em>${eur(p.complete)}</em></span></button>
  </div>`;
  if(next){next.disabled=!explicitChoice;next.textContent=explicitChoice?'Voir mon devis':'Choisissez votre prestation'}
  if(txt&&!explicitChoice)txt.innerHTML=`Bbio <b>${eur(p.permis)}</b> · Bbio + FDC <b>${eur(p.fdc)}</b> · totale <b>${eur(p.complete)}</b>`;
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
  box.innerHTML=`<div class="panel-h"><span class="chip o">Vous pourrez compléter plus tard</span><h3>Passer à la FDC ou à l’étude totale</h3></div><div class="note info"><b>Bbio + FDC :</b> ${eur(p.fdc)} TTC<br><b>Bbio + FDC + ACV :</b> ${eur(p.complete)} TTC</div>`;
  pay.parentNode.insertBefore(box,pay);
}

function tune(){
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
  if(!b)return;
  if(b.dataset.act==='calculate-quote'){
    hasCalculated=true;
    explicitChoice=false;
    chosen='permis';
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