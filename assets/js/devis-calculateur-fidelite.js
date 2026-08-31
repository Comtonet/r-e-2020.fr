(function(){
'use strict';
const root=document.getElementById('devis-app'); if(!root) return;
const qs=(s)=>root.querySelector(s), qsa=(s)=>Array.from(root.querySelectorAll(s));
let lock=false;
function tune(){
  if(lock) return; lock=true;
  try{
    const steps=qsa('#quoteSteps .stp');
    const labels=['Dossier','Saisie','Devis'];
    steps.forEach((el,i)=>{ if(labels[i]){ const icon=el.querySelector('i'); const txt=labels[i]; if(icon){ while(icon.nextSibling) icon.nextSibling.remove(); el.append(document.createTextNode(txt)); } } });

    const screen=qs('#quoteScreen');
    if(screen && screen.querySelector('.planche')){
      const hero=screen.querySelector('.hero');
      if(hero){
        const eye=hero.querySelector('.eyebrow'); if(eye) eye.textContent='Étape 1 · Votre dossier';
        const h1=hero.querySelector('h1'); if(h1) h1.innerHTML='Chiffrez votre étude<em>thermique RE2020.</em>';
        const lead=hero.querySelector('.lede'); if(lead) lead.textContent='Quatre réponses suffisent pour obtenir un devis immédiat. Vous décrivez ensuite votre opération, et le montant se calcule au fur et à mesure de votre saisie.';
      }
      const blocks=screen.querySelectorAll('.block');
      if(blocks[0]){
        const h=blocks[0].querySelector('h2'); if(h) h.textContent='Je souhaite';
        const p=blocks[0].querySelector('.hint'); if(p) p.textContent='Deux niveaux de prestation distincts. Leurs montants ne s’additionnent pas.';
      }

      qsa('.infobadge').forEach(x=>x.remove());
      const collectif=qsa('.planche').find(p=>p.querySelector('.code')?.textContent.trim()==='COL');
      if(collectif){
        const tiles=collectif.querySelectorAll('.tile');
        [1,2].forEach(i=>{ const cap=tiles[i]?.querySelector('.cap'); if(cap&&!cap.querySelector('.infobadge')){ const b=document.createElement('span'); b.className='infobadge'; b.tabIndex=0; b.dataset.info=i===1?'col-2x2':'col-sup3'; b.setAttribute('role','button'); b.setAttribute('aria-label','Voir le logigramme de qualification du bâtiment'); b.textContent='i'; cap.appendChild(b); } });
      }
    }

    const recap=qs('#quoteRail .recap');
    if(recap){ const h=recap.querySelector('.recap-h h4'); if(h) h.textContent='Votre dossier'; }

    const doc=screen?.querySelector('.doc');
    const bar=qs('#quoteBar'), back=qs('#quoteBack'), next=qs('#quoteNext'), txt=qs('#quoteBarTxt');
    if(doc && bar && back && next && txt){
      bar.classList.add('show'); back.hidden=false; next.hidden=false; next.disabled=false;
      next.textContent='Payer l’acompte';
      const total=doc.querySelector('.tot .l.big .n')?.textContent||'';
      txt.innerHTML='Total TTC <b>'+total+'</b>';
      back.onclick=()=>{ const b=screen.querySelector('[data-act="goto"][data-e="saisie"]'); if(b) b.click(); };
      next.onclick=()=>{ const b=screen.querySelector('[data-act="pay"]'); if(b) b.click(); };
    }
  } finally { lock=false; }
}
function showInfo(b){
  const tip=qs('#quoteInfotip'); if(!tip) return;
  tip.querySelector('.infotip-body').innerHTML='<strong style="display:block;margin-bottom:8px">Qualification maison / maisons accolées / collectif</strong><p style="margin:0 0 8px;color:#4E5872;font-size:13px">Le fichier de référence associe cette aide aux variantes collectif 2×2 et collectif superposé 3+. Elle permet de vérifier si l’opération relève d’une maison individuelle, de maisons accolées ou d’un bâtiment collectif d’habitation.</p><p style="margin:0;color:#7B849C;font-size:12px">La qualification dépend notamment du nombre de logements, de leur superposition et de l’existence d’une porte d’entrée commune.</p>';
  const r=b.getBoundingClientRect(); tip.style.left=Math.max(12,Math.min(innerWidth-472,r.left-420))+'px'; tip.style.top=Math.min(innerHeight-220,r.bottom+8)+'px'; tip.classList.add('show');
}
root.addEventListener('click',e=>{ const b=e.target.closest('.infobadge'); if(b){ e.preventDefault(); e.stopPropagation(); showInfo(b); return; } if(!e.target.closest('#quoteInfotip')) qs('#quoteInfotip')?.classList.remove('show'); });
root.addEventListener('keydown',e=>{ const b=e.target.closest('.infobadge'); if(b&&(e.key==='Enter'||e.key===' ')){ e.preventDefault(); e.stopPropagation(); showInfo(b); } });
new MutationObserver(()=>tune()).observe(root,{childList:true,subtree:true});
setTimeout(tune,0);
})();