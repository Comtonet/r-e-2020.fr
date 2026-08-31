(function(){
'use strict';
const root=document.getElementById('devis-app');
if(!root)return;
let autoInit=false;
let explicitChoice=false;
let chosen='permis';
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
  if(lead)lead.textContent='Répondez simplement aux questions sur votre projet. Le choix entre dépôt de PC et étude complète se fera à la toute fin.';
  return true;
}

function prices(){
  const m=qa('#quoteRail .money .amt');
  return {permis:parseEur(m[0]?.textContent),complete:parseEur(m[1]?.textContent)};
}

function addFinalChoice(){
  const screen=q('#quoteScreen');
  if(!screen||!screen.querySelector('.lot'))return false;
  let box=screen.querySelector('.final-prestation-lite');
  const p=prices();
  if(!box){
    box=document.createElement('section');
    box.className='panel final-prestation-lite';
    screen.appendChild(box);
  }
  box.innerHTML=`<div class="panel-h"><span class="chip o">Dernière étape</span><h3>Que souhaitez-vous commander ?</h3></div>
  <p class="hint">Le projet est entièrement décrit. Choisissez maintenant votre niveau de prestation.</p>
  <div class="opts two final-presta-grid">
    <button class="opt" data-act="prestation" data-id="permis" aria-pressed="${explicitChoice&&chosen==='permis'}"><span class="tick"></span><span><strong>Dépôt de permis de construire</strong><small>Étude réglementaire + attestation PC.</small><em>${eur(p.permis)}</em></span></button>
    <button class="opt" data-act="prestation" data-id="complete" aria-pressed="${explicitChoice&&chosen==='complete'}"><span class="tick"></span><span><strong>Étude RE2020 complète</strong><small>PC + Cep, Cep,nr, DH, ACV et livrables complets.</small><em>${eur(p.complete)}</em></span></button>
  </div>`;
  const next=q('#quoteNext');
  const txt=q('#quoteBarTxt');
  if(next){next.disabled=!explicitChoice;next.textContent=explicitChoice?'Voir mon devis':'Choisissez votre prestation'}
  if(txt&&!explicitChoice)txt.innerHTML=`Projet chiffré : PC <b>${eur(p.permis)}</b> · étude complète <b>${eur(p.complete)}</b>`;
  return true;
}

function addPermitInfo(){
  const screen=q('#quoteScreen');
  if(!screen||!screen.querySelector('.doc')||chosen!=='permis')return;
  if(screen.querySelector('.permit-info-lite'))return;
  const p=prices();
  const sup=Math.max(0,p.complete-p.permis);
  const pay=screen.querySelector('.pay');
  if(!pay)return;
  const box=document.createElement('div');
  box.className='panel permit-info-lite';
  box.innerHTML=`<div class="panel-h"><span class="chip o">À titre informatif</span><h3>Si vous souhaitez compléter l’étude après le PC</h3></div><p class="hint">Le complément dépend réellement de votre projet et de sa typologie.</p><div class="note info"><b>Cep, Cep,nr, DH + ACV RE2020</b><br>Complément calculé pour ce dossier : <strong>+ ${eur(sup)} TTC</strong> · étude complète : <strong>${eur(p.complete)} TTC</strong>.</div>`;
  pay.parentNode.insertBefore(box,pay);
}

function tune(){
  ensureDefault();
  const onHome=lightenHome();
  const onSaisie=addFinalChoice();
  if(!onHome&&!onSaisie)addPermitInfo();
  root.classList.add('devis-lite-site');
}

root.addEventListener('click',e=>{
  const b=e.target.closest('[data-act]');
  if(!b)return;
  if(b.dataset.act==='prestation'&&b.closest('.final-prestation-lite')){
    explicitChoice=true;
    chosen=b.dataset.id;
  }
  if(b.dataset.act==='nature'||b.dataset.act==='famille'){
    explicitChoice=false;
    chosen='permis';
  }
  setTimeout(tune,0);
},true);
root.addEventListener('input',()=>setTimeout(tune,0),true);
q('#quoteNext')?.addEventListener('click',()=>setTimeout(tune,0));
q('#quoteBack')?.addEventListener('click',()=>setTimeout(tune,0));
setTimeout(tune,0);
})();
