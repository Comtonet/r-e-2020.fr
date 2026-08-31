<?php
/* Calculateur de devis RE2020 — projets hors maison individuelle. */
?>
<section class="quote-hero">
  <div class="container quote-hero-grid">
    <div>
      <span class="eyebrow">Devis RE2020 en ligne</span>
      <h1>Chiffrez votre projet RE2020 en quelques minutes.</h1>
      <p class="hero-lead">Collectif, tertiaire, extension ou opération mixte : décrivez votre projet et obtenez immédiatement une estimation calculée à partir de notre grille de chiffrage.</p>
      <div class="quote-trust"><span>✓ Collectif</span><span>✓ Tertiaire</span><span>✓ Extensions</span><span>✓ Opérations mixtes</span></div>
    </div>
    <div class="quote-hero-card">
      <strong>Ce calculateur concerne les projets hors maison individuelle.</strong>
      <p>Pour une maison individuelle seule, utilisez directement notre page tarif maison.</p>
      <a class="btn btn-ghost" href="/maison-individuelle/">Voir les tarifs maison</a>
    </div>
  </div>
</section>

<section class="quote-section">
  <div class="container">
    <div class="quote-shell" id="quoteApp">
      <div class="quote-main">
        <div class="quote-progress"><span class="on" data-stepdot="1">1. Projet</span><span data-stepdot="2">2. Configuration</span><span data-stepdot="3">3. Devis</span></div>

        <div class="quote-step" data-step="1">
          <div class="quote-head"><span class="eyebrow">Étape 1</span><h2>Quel est votre projet ?</h2><p>Choisissez d’abord la prestation, la nature de l’opération puis le type de bâtiment.</p></div>

          <div class="quote-block"><h3>Prestation souhaitée</h3><div class="choice-grid two">
            <button type="button" class="choice selected" data-set="prestation" data-value="permis"><b>Permis de construire uniquement</b><small>Étude réglementaire + attestation de prise en compte de la RE2020.</small></button>
            <button type="button" class="choice" data-set="prestation" data-value="complete"><b>Étude complète</b><small>Permis + étude jusqu’à la fin des travaux : Cep, Cep,nr, DH, ACV et RSET.</small></button>
          </div></div>

          <div class="quote-block"><h3>Nature de l’opération</h3><div class="choice-grid">
            <button type="button" class="choice selected" data-set="nature" data-value="neuf"><b>Bâtiment(s) neuf(s)</b></button>
            <button type="button" class="choice" data-set="nature" data-value="ext"><b>Extension</b></button>
            <button type="button" class="choice" data-set="nature" data-value="mixte-ne"><b>Mixte neuf / extension</b></button>
            <button type="button" class="choice" data-set="nature" data-value="reno-ext"><b>Rénovation / réhabilitation + extension</b></button>
            <button type="button" class="choice" data-set="nature" data-value="reno-neuf"><b>Rénovation / réhabilitation + bâtiment neuf</b></button>
          </div></div>

          <div class="quote-block"><h3>Type de projet</h3><p class="quote-hint">La maison individuelle seule n’est volontairement pas proposée ici.</p><div class="family-grid">
            <button type="button" class="family selected" data-set="famille" data-value="collectif"><div class="family-pics"><img src="/assets/img/calculateur-devis/col-igh.webp" alt="Collectif"><img src="/assets/img/calculateur-devis/col-2x2.webp" alt="Collectif"><img src="/assets/img/calculateur-devis/col-sup3.webp" alt="Collectif"></div><b>Logement collectif</b><small>Chiffrage bâtiment par bâtiment selon le nombre de logements.</small></button>
            <button type="button" class="family" data-set="famille" data-value="tertiaire"><div class="family-pics"><img src="/assets/img/calculateur-devis/ter-ateliers.webp" alt="Bâtiment d’activité"><img src="/assets/img/calculateur-devis/ter-commerce.webp" alt="Commerce"><img src="/assets/img/calculateur-devis/ter-industries.webp" alt="Industrie"></div><b>Bâtiment d’activité / tertiaire</b><small>Bureaux, enseignement, santé, commerce, industrie, hébergement, sports…</small></button>
            <button type="button" class="family" data-set="famille" data-value="mixte"><div class="family-pics"><img src="/assets/img/calculateur-devis/mix-divers.webp" alt="Opération mixte"><img src="/assets/img/calculateur-devis/mix-pied-immeuble.webp" alt="Pied d’immeuble"><img src="/assets/img/calculateur-devis/mix-log-fonction.webp" alt="Usage mixte"></div><b>Opération à usage mixte</b><small>Plusieurs usages dans une même opération avec récapitulatif commun.</small></button>
          </div></div>

          <button class="btn quote-next" type="button" data-go="2">Configurer mon projet</button>
        </div>

        <div class="quote-step" data-step="2" hidden>
          <div class="quote-head"><span class="eyebrow">Étape 2</span><h2>Précisez les caractéristiques.</h2><p id="configIntro"></p></div>
          <div id="configArea"></div>
          <div class="quote-actions"><button class="btn btn-ghost" type="button" data-go="1">Retour</button><button class="btn" type="button" data-go="3">Calculer mon devis</button></div>
        </div>

        <div class="quote-step" data-step="3" hidden>
          <div class="quote-head"><span class="eyebrow">Étape 3</span><h2>Votre estimation RE2020</h2><p>Le détail ci-dessous reprend le moteur de chiffrage transmis pour les projets hors maison individuelle.</p></div>
          <div class="quote-result" id="quoteResult"></div>
          <div class="quote-actions"><button class="btn btn-ghost" type="button" data-go="2">Modifier</button><a class="btn" href="/inscription-en-cours/">Créer mon compte et continuer</a></div>
          <p class="quote-disclaimer">Estimation indicative calculée selon les informations saisies. Le dossier reste soumis à validation par Keeplanet.</p>
        </div>
      </div>
      <aside class="quote-recap" id="quoteRecap"></aside>
    </div>
  </div>
</section>

<style>
.quote-hero{padding:72px 0 42px;background:linear-gradient(135deg,#f5fbf8 0%,#f4f8ff 100%)}
.quote-hero-grid{display:grid;grid-template-columns:minmax(0,1.4fr) minmax(300px,.7fr);gap:38px;align-items:center}.quote-hero h1{max-width:820px}.quote-trust{display:flex;flex-wrap:wrap;gap:10px;margin-top:22px}.quote-trust span{background:#fff;border:1px solid #dce8e3;border-radius:999px;padding:8px 12px;font-size:.9rem}.quote-hero-card{background:#fff;border:1px solid #dfe8e5;border-radius:22px;padding:24px;box-shadow:0 18px 50px rgba(15,52,45,.08)}.quote-hero-card p{color:#5d6b68}.quote-section{padding:48px 0 90px;background:#f7f9fb}.quote-shell{display:grid;grid-template-columns:minmax(0,1fr) 320px;gap:28px;align-items:start}.quote-main{background:#fff;border:1px solid #e1e8e6;border-radius:24px;padding:28px;box-shadow:0 16px 45px rgba(19,45,38,.06)}.quote-progress{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:30px}.quote-progress span{padding:7px 12px;border-radius:999px;background:#eef2f1;color:#6b7774;font-size:.82rem;font-weight:700}.quote-progress span.on{background:#0f6b54;color:#fff}.quote-head{margin-bottom:28px}.quote-head h2{margin-bottom:8px}.quote-head p,.quote-hint{color:#66736f}.quote-block{padding:22px 0;border-top:1px solid #edf1f0}.quote-block:first-of-type{border-top:0}.quote-block h3{font-size:1.06rem;margin-bottom:12px}.choice-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px}.choice-grid.two{grid-template-columns:repeat(2,minmax(0,1fr))}.choice,.family,.usage-card{appearance:none;text-align:left;background:#fff;border:1px solid #dce5e2;border-radius:16px;padding:16px;cursor:pointer;transition:.18s;color:inherit}.choice:hover,.family:hover,.usage-card:hover{border-color:#7bb5a3;transform:translateY(-1px)}.choice.selected,.family.selected,.usage-card.selected{border:2px solid #13805f;background:#f1fbf7;box-shadow:0 0 0 3px rgba(19,128,95,.08)}.choice b,.family b,.usage-card b{display:block}.choice small,.family small,.usage-card small{display:block;color:#687570;margin-top:5px;line-height:1.4}.family-grid{display:grid;gap:14px}.family{width:100%}.family-pics{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:12px}.family-pics img{width:100%;height:118px;object-fit:contain;background:#f4f7f6;border-radius:10px}.quote-next{margin-top:8px}.quote-actions{display:flex;justify-content:space-between;gap:12px;margin-top:26px}.quote-panel{border:1px solid #dfe8e5;border-radius:18px;padding:20px;margin-bottom:16px;background:#fbfcfc}.quote-panel h3{margin:0 0 14px}.field-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px}.qfield label{display:block;font-size:.88rem;font-weight:700;margin-bottom:6px}.qfield input,.qfield select{width:100%;border:1px solid #cad8d4;border-radius:10px;background:#fff;padding:11px 12px;font:inherit}.usage-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px}.building-row{display:grid;grid-template-columns:1fr auto;gap:10px;margin-bottom:9px}.building-row button,.remove-lot{border:0;background:#f6e9e7;color:#9d3e32;border-radius:9px;padding:0 12px;cursor:pointer}.mini-add{border:1px dashed #13805f;color:#0f6b54;background:#f2fbf7;border-radius:10px;padding:10px 13px;font-weight:700;cursor:pointer}.lot-card{border:1px solid #dfe8e5;border-radius:16px;margin-bottom:12px;overflow:hidden}.lot-head{display:flex;justify-content:space-between;align-items:center;padding:12px 14px;background:#f4f8f6}.lot-body{padding:14px}.quote-recap{position:sticky;top:92px;background:#0e3c34;color:#fff;border-radius:22px;padding:20px;box-shadow:0 18px 45px rgba(14,60,52,.18)}.quote-recap h3{color:#fff;margin-top:0}.recap-line{display:flex;justify-content:space-between;gap:12px;padding:9px 0;border-bottom:1px solid rgba(255,255,255,.12);font-size:.9rem}.recap-line span{opacity:.74}.recap-price{margin-top:18px;padding-top:16px;border-top:1px solid rgba(255,255,255,.2)}.recap-price small{display:block;opacity:.7}.recap-price strong{font-size:1.7rem}.quote-result{border:1px solid #dce7e3;border-radius:20px;overflow:hidden}.result-top{padding:22px;background:#0e3c34;color:#fff;display:flex;justify-content:space-between;gap:20px;align-items:end}.result-top small{display:block;opacity:.72}.result-top strong{font-size:2rem}.result-lines{padding:8px 20px}.result-line{display:flex;justify-content:space-between;gap:20px;padding:13px 0;border-bottom:1px solid #edf1ef}.result-line:last-child{border:0}.result-line small{display:block;color:#72807c}.quote-disclaimer{font-size:.82rem;color:#75817e;margin-top:14px}.reno-note{padding:14px 16px;border-left:4px solid #c16d49;background:#fff6f1;border-radius:10px;margin-bottom:16px;color:#754b39}
@media(max-width:980px){.quote-hero-grid,.quote-shell{grid-template-columns:1fr}.quote-recap{position:static;order:-1}.quote-hero{padding-top:48px}}@media(max-width:680px){.quote-main{padding:18px}.choice-grid,.choice-grid.two,.usage-grid,.field-grid{grid-template-columns:1fr}.family-pics img{height:82px}.quote-actions{flex-direction:column}.quote-actions .btn{width:100%;text-align:center}.result-top{align-items:flex-start;flex-direction:column}}
</style>

<script>
(function(){
  const state={step:1,prestation:'permis',nature:'neuf',famille:'collectif',collectif:[18],usage:'BUR',vals:{S:200,n:1,resto:'non',sc:15,sj:15},lots:[]};
  const COMPL=429, COL_METRE=[[3,175],[6,250],[10,280],[11,500],[16,680],[21,860]], COL_COMPL=[[3,199],[6,299],[16,349]], GRILLE_LOCAL=[[0,3.5],[12.5,3],[17.5,1.5],[22.5,1.25]], GRILLE_BUR=[[0,3.5],[12.5,3],[17.5,1.5],[22.5,1.25],[50,1.1]];
  const usages={
    BUR:{n:'Bureaux',d:'Bureaux, open space, co-working ou coque vide.',fields:['S','n'],defaults:{S:200,n:1}},
    ENS:{n:'Enseignement primaire / secondaire',d:'Écoles, collèges, lycées.',fields:['S','n','resto'],defaults:{S:500,n:10,resto:'non'}},
    SAN:{n:'Cabinet de santé',d:'Cabinets médicaux, maisons de santé, salles de soins.',fields:['S','n'],defaults:{S:200,n:6}},
    SOC:{n:'Locaux sociaux',d:'Vestiaires et espace de restauration du personnel.',fields:['S','n'],defaults:{S:120,n:2}},
    VEN:{n:'Vente / commerce',d:'Surfaces de vente, boutiques, galeries commerciales.',fields:['S','resto'],defaults:{S:500,resto:'non'}},
    IND:{n:'Industrie et artisanat',d:'Ateliers, halls de production, entrepôts chauffés.',fields:['S','resto'],defaults:{S:800,resto:'non'}},
    FOY:{n:'Foyers, cité U, EHPAD, chambres',d:'Résidences étudiantes, foyers, EHPAD, chambres meublées.',fields:['S','n','resto'],defaults:{S:600,n:20,resto:'non'}},
    RES:{n:'Restaurants',d:'Restaurants, brasseries, cafés.',fields:['S'],defaults:{S:300}},
    SPO:{n:'Sports',d:'Salles de sport, gymnases, dojos.',fields:['S','resto'],defaults:{S:700,resto:'non'}},
    HOP:{n:'Hôpitaux complets',d:'Établissements avec zones nuit, jour et opération.',fields:['S','sc','sj','resto'],defaults:{S:2000,sc:15,sj:15,resto:'non'}},
    CRE:{n:'Crèches et haltes-garderies',d:'Dortoirs, salles d’activité, multi-accueil.',fields:['S','n','resto'],defaults:{S:300,n:8,resto:'non'}},
    VES:{n:'Vestiaires seuls',d:'Blocs vestiaires isolés.',fields:['S','n'],defaults:{S:60,n:3}}
  };
  const $=s=>document.querySelector(s), $$=s=>Array.from(document.querySelectorAll(s));
  const num=v=>isFinite(+v)?+v:0, eur=n=>(Math.round(n*100)/100).toLocaleString('fr-FR',{style:'currency',currency:'EUR'}), seuil=(x,t,d)=>{let r=d; t.forEach(a=>{if(x>=a[0])r=a[1]});return r};
  function power(v,resto){const S=num(v.S),b=39.18*Math.pow(Math.max(S,0),.43),m=resto&&v.resto==='oui'?100:0;return {p:b+m,lines:[['Prix de base',`39,18 × ${S} m² ^ 0,43`,b],...(m?[['Article de métré – restauration','1 × 100 €',100]]:[])]}}
  function calcUsage(code,v){let S=num(v.S),n=num(v.n),p,r,c,sa,m,lines=[];
    if(code==='BUR'){p=n<=0?1.1:seuil(S/n,GRILLE_BUR,3.5);r=.1*S;c=.25*S;sa=.035*S;return {p:S*p+r+c+sa,lines:[['Surface × prix unitaire',`${S} m² × ${p} €/m²`,S*p],['Salle de réunion','coefficient 0,100',r],['Circulation et accueil','coefficient 0,250',c],['Sanitaires collectifs','coefficient 0,035',sa]]}}
    if(code==='ENS'){p=n<=0?1.1:seuil(S/n,[[0,1.5],[25,1.1]],1.5);m=v.resto==='oui'?100:0;return {p:S*p+m,lines:[['Surface × prix unitaire',`${S} m² × ${p} €/m²`,S*p],...(m?[['Article de métré – cantine','1 × 100 €',100]]:[])]}}
    if(code==='SAN'){p=n<=0?1.25:seuil(S/n,GRILLE_LOCAL,3.5);return {p:S*p,lines:[['Surface × prix unitaire',`${S} m² × ${p} €/m²`,S*p]]}}
    if(code==='SOC'){return {p:n*100+S*1.25,lines:[['Surface × prix unitaire',`${S} m² × 1,25 €/m²`,S*1.25],['Articles de métré',`${n} × 100 €`,n*100]]}}
    if(code==='VEN'||code==='IND'||code==='SPO')return power(v,true);
    if(code==='RES')return power(v,false);
    if(code==='FOY'||code==='CRE'){p=n<=0?1.25:seuil(S/n,GRILLE_LOCAL,3.5);m=v.resto==='oui'?100:0;return {p:S*p+m,lines:[['Surface × prix unitaire',`${S} m² × ${p} €/m²`,S*p],...(m?[['Article de métré – restauration','1 × 100 €',100]]:[])]}}
    if(code==='HOP'){const G=[[0,3.5],[12.5,3],[17.5,1.5]],pn=seuil(num(v.sc),G,3.5),pj=seuil(num(v.sj),G,3.5),rr=v.resto==='oui',fn=.5,fj=rr?.25:.3,fo=rr?.15:.2,fr=rr?.1:0;lines=[['Zone nuit',`${S*fn} m² × ${pn} €/m²`,S*fn*pn],['Zone jour',`${S*fj} m² × ${pj} €/m²`,S*fj*pj],['Zone opération',`${S*fo} m² × 1,25 €/m²`,S*fo*1.25]];if(fr)lines.push(['Zone de restauration',`${S*fr} m² × 4,50 €/m²`,S*fr*4.5]);return {p:lines.reduce((a,x)=>a+x[2],0),lines}}
    if(code==='VES'){p=n<=0?1:seuil(S/n,[[0,3.5],[20,1.5],[30,1]],3.5);return {p:S*p+130,lines:[['Surface × prix unitaire',`${S} m² × ${p} €/m²`,S*p],['Forfait vestiaires','130 €',130]]}}
    return {p:0,lines:[]};
  }
  function calcCollectif(){let metre=0,compl=0,lines=[];state.collectif.forEach((L,i)=>{L=num(L);if(L<3)return;const m=seuil(L,COL_METRE,0),c=seuil(L,COL_COMPL,0);metre+=m;compl+=c;lines.push([`Bâtiment ${String.fromCharCode(65+i)}`,`${L} logements`,m,state.prestation==='complete'?c:0])});const total=state.prestation==='complete'?metre+390+compl:metre+210;lines.push([state.prestation==='complete'?'Forfait étude complète':'Forfait étude BBIO','',state.prestation==='complete'?390:210,0]);return {p:total,lines:lines.map(x=>[x[0],x[1],x[2]+x[3]])}}
  function fields(v,scope){const defs={S:['Surface totale / de référence','m²',10],n:['Nombre de locaux / salles / chambres','',1],resto:['Zone de restauration','','select'],sc:['Surface moyenne d’une chambre','m²',1],sj:['Surface moyenne d’une salle de consultation','m²',1]};return usages[scope].fields.map(k=>{let d=defs[k];if(k==='resto')return `<div class="qfield"><label>${d[0]}</label><select data-v="${k}"><option value="non" ${v[k]!=='oui'?'selected':''}>Non</option><option value="oui" ${v[k]==='oui'?'selected':''}>Oui</option></select></div>`;return `<div class="qfield"><label>${d[0]} ${d[1]?`(${d[1]})`:''}</label><input type="number" min="0" step="${d[2]}" data-v="${k}" value="${num(v[k])}"></div>`}).join('')}
  function renderConfig(){const a=$('#configArea');if(state.nature==='reno-ext'||state.nature==='reno-neuf')a.innerHTML='<div class="reno-note"><b>La partie rénovée ou réhabilitée n’entre pas dans le chiffrage RE2020.</b> Seule la partie neuve ou l’extension est prise en compte.</div>';
    else a.innerHTML='';
    if(state.famille==='collectif'){ $('#configIntro').textContent='Indiquez le nombre de logements de chaque bâtiment collectif.';a.insertAdjacentHTML('beforeend',`<div class="quote-panel"><h3>Bâtiments collectifs</h3><div id="buildingRows"></div><button type="button" class="mini-add" id="addBuilding">+ Ajouter un bâtiment</button></div>`);renderBuildings();return}
    if(state.famille==='tertiaire'){ $('#configIntro').textContent='Choisissez l’usage principal puis renseignez ses caractéristiques.';a.insertAdjacentHTML('beforeend',`<div class="quote-panel"><h3>Usage du bâtiment</h3><div class="usage-grid">${Object.keys(usages).map(k=>`<button type="button" class="usage-card ${state.usage===k?'selected':''}" data-usage="${k}"><b>${usages[k].n}</b><small>${usages[k].d}</small></button>`).join('')}</div></div><div class="quote-panel"><h3 id="usageTitle"></h3><div class="field-grid" id="usageFields"></div></div>`);renderUsageFields();return}
    $('#configIntro').textContent='Ajoutez les différents usages de votre opération. Vous pouvez combiner logement collectif et activités.';if(!state.lots.length)state.lots=[{type:'COL',name:'Logements collectifs',bats:[6]},{type:'BUR',name:'Bureaux',vals:{...usages.BUR.defaults}}];a.insertAdjacentHTML('beforeend',`<div id="lotsArea"></div><button type="button" class="mini-add" id="addLot">+ Ajouter un usage</button>`);renderLots();
  }
  function renderBuildings(){const box=$('#buildingRows');if(!box)return;box.innerHTML=state.collectif.map((v,i)=>`<div class="building-row"><input type="number" min="3" step="1" data-building="${i}" value="${v}"><button type="button" data-delbuilding="${i}" ${state.collectif.length===1?'disabled':''}>×</button></div>`).join('');}
  function renderUsageFields(){const u=usages[state.usage];$('#usageTitle').textContent=u.n;$('#usageFields').innerHTML=fields(state.vals,state.usage)}
  function renderLots(){const box=$('#lotsArea');if(!box)return;box.innerHTML=state.lots.map((l,i)=>{if(l.type==='COL')return `<div class="lot-card"><div class="lot-head"><b>${l.name}</b><button class="remove-lot" data-dellot="${i}">×</button></div><div class="lot-body"><label>Nombre de logements du bâtiment</label><input type="number" min="3" data-lotcol="${i}" value="${l.bats[0]}"></div></div>`;return `<div class="lot-card"><div class="lot-head"><b>${usages[l.type].n}</b><button class="remove-lot" data-dellot="${i}">×</button></div><div class="lot-body"><div class="qfield"><label>Usage</label><select data-lottype="${i}">${Object.keys(usages).map(k=>`<option value="${k}" ${k===l.type?'selected':''}>${usages[k].n}</option>`).join('')}</select></div><div class="field-grid">${fields(l.vals,l.type).replaceAll('data-v=',`data-lotv="${i}:`).replaceAll('" value','"" value').replaceAll('" selected','"" selected')}</div></div></div>`}).join('')}
  function total(){if(state.famille==='collectif')return calcCollectif();if(state.famille==='tertiaire'){const c=calcUsage(state.usage,state.vals);return state.prestation==='complete'?{p:c.p+COMPL,lines:[...c.lines,['Complément étude complète','130 € + 299 €',COMPL]]}:c}let p=0,lines=[];state.lots.forEach(l=>{if(l.type==='COL'){const old=state.collectif;state.collectif=l.bats;const c=calcCollectif();state.collectif=old;p+=c.p;lines.push(...c.lines.map(x=>[`${l.name} — ${x[0]}`,x[1],x[2]]))}else{const c=calcUsage(l.type,l.vals);p+=c.p+(state.prestation==='complete'?COMPL:0);lines.push(...c.lines.map(x=>[`${usages[l.type].n} — ${x[0]}`,x[1],x[2]]));if(state.prestation==='complete')lines.push([`${usages[l.type].n} — complément étude complète`,'130 € + 299 €',COMPL])}});return {p,lines}}
  function recap(){const fam={collectif:'Logement collectif',tertiaire:'Bâtiment d’activité',mixte:'Opération mixte'}[state.famille],nat={neuf:'Bâtiment(s) neuf(s)',ext:'Extension','mixte-ne':'Neuf / extension','reno-ext':'Réhabilitation + extension','reno-neuf':'Réhabilitation + bâtiment neuf'}[state.nature],t=total();$('#quoteRecap').innerHTML=`<h3>Votre projet</h3><div class="recap-line"><span>Prestation</span><b>${state.prestation==='complete'?'Étude complète':'Permis'}</b></div><div class="recap-line"><span>Nature</span><b>${nat}</b></div><div class="recap-line"><span>Type</span><b>${fam}</b></div><div class="recap-price"><small>Estimation actuelle</small><strong>${eur(t.p)}</strong></div>`}
  function result(){const t=total();$('#quoteResult').innerHTML=`<div class="result-top"><div><small>${state.prestation==='complete'?'Étude RE2020 complète':'Phase permis de construire'}</small><b>Estimation calculée</b></div><strong>${eur(t.p)}</strong></div><div class="result-lines">${t.lines.map(l=>`<div class="result-line"><div><b>${l[0]}</b>${l[1]?`<small>${l[1]}</small>`:''}</div><strong>${eur(l[2])}</strong></div>`).join('')}</div>`}
  function go(n){state.step=n;$$('.quote-step').forEach(x=>x.hidden=+x.dataset.step!==n);$$('[data-stepdot]').forEach(x=>x.classList.toggle('on',+x.dataset.stepdot===n));if(n===2)renderConfig();if(n===3)result();recap();$('#quoteApp').scrollIntoView({behavior:'smooth',block:'start'})}
  document.addEventListener('click',e=>{const b=e.target.closest('button');if(!b)return;if(b.dataset.set){state[b.dataset.set]=b.dataset.value;$$(`[data-set="${b.dataset.set}"]`).forEach(x=>x.classList.toggle('selected',x===b));recap()}if(b.dataset.go)go(+b.dataset.go);if(b.dataset.usage){state.usage=b.dataset.usage;state.vals={...usages[state.usage].defaults};$$('[data-usage]').forEach(x=>x.classList.toggle('selected',x===b));renderUsageFields();recap()}if(b.id==='addBuilding'){state.collectif.push(6);renderBuildings();recap()}if(b.dataset.delbuilding!==undefined){state.collectif.splice(+b.dataset.delbuilding,1);renderBuildings();recap()}if(b.id==='addLot'){state.lots.push({type:'BUR',name:'Bureaux',vals:{...usages.BUR.defaults}});renderLots();recap()}if(b.dataset.dellot!==undefined){state.lots.splice(+b.dataset.dellot,1);renderLots();recap()}});
  document.addEventListener('input',e=>{if(e.target.dataset.building!==undefined){state.collectif[+e.target.dataset.building]=num(e.target.value);recap()}if(e.target.dataset.v){state.vals[e.target.dataset.v]=e.target.value;recap()}if(e.target.dataset.lotcol!==undefined){state.lots[+e.target.dataset.lotcol].bats[0]=num(e.target.value);recap()}});
  document.addEventListener('change',e=>{if(e.target.dataset.v){state.vals[e.target.dataset.v]=e.target.value;recap()}if(e.target.dataset.lottype!==undefined){const i=+e.target.dataset.lottype,k=e.target.value;state.lots[i]={type:k,name:usages[k].n,vals:{...usages[k].defaults}};renderLots();recap()}});
  $$('img').forEach(img=>img.addEventListener('error',()=>img.style.visibility='hidden'));
  recap();
})();
</script>
