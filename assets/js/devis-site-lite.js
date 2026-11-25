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
let businessInput=false;
let finalKey='';
let accountDraft={};
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
  loader.setAttribute('role','status');
  loader.setAttribute('aria-live','polite');
  loader.innerHTML=`<div class="quote-loader-card"><svg class="quote-infinity" viewBox="0 0 112 56" fill="none" aria-hidden="true" focusable="false"><path class="quote-infinity-track" d="M56 28C44 11 35 8 24 8C12 8 5 17 5 28S12 48 24 48C35 48 44 45 56 28S77 8 88 8C100 8 107 17 107 28S100 48 88 48C77 48 68 45 56 28Z" pathLength="100"/><path class="quote-infinity-run" d="M56 28C44 11 35 8 24 8C12 8 5 17 5 28S12 48 24 48C35 48 44 45 56 28S77 8 88 8C100 8 107 17 107 28S100 48 88 48C77 48 68 45 56 28Z" pathLength="100"/></svg><strong>Calcul de votre devis</strong><span>Nous préparons les prestations adaptées à votre projet…</span><div class="quote-loader-line"><b></b></div></div>`;
  root.appendChild(loader);
}

function showLoader(){
  ensureLoader();
  calculating=true;
  const loader=q('.quote-loader');
  if(loader){loader.classList.add('show');loader.setAttribute('aria-hidden','false')}
  root.classList.add('is-calculating');
  root.setAttribute('aria-busy','true');
  const screen=q('#quoteScreen');if(screen)screen.inert=true;
}

function hideLoader(){
  calculating=false;
  const loader=q('.quote-loader');
  if(loader){loader.classList.remove('show');loader.setAttribute('aria-hidden','true')}
  root.classList.remove('is-calculating');
  root.removeAttribute('aria-busy');
  const screen=q('#quoteScreen');if(screen)screen.inert=false;
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
  const onEntry=window.KP_QUOTE_ENGINE?.getState()?.ecran==='saisie';
  const onDoc=!!screen.querySelector('.doc');
  if(!onHome&&!onEntry&&!onDoc)return;
  const step=onHome?1:onEntry?(hasCalculated?3:2):3;
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
  if(left[1]){const h=left[1].querySelector('h2');if(h)h.textContent='2. Quel type de bâtiment concerne l’opération ?';left[1].hidden=window.KP_QUOTE_ENGINE?.getState()?.nature==='mixte-ne'}
  qa('.planche .tiles').forEach(tiles=>tiles.classList.remove('tiles-lite'));
  const lead=screen.querySelector('.hero .lede');
  if(lead)lead.textContent='Décrivez votre projet en quelques clics. Vous pourrez ensuite choisir le niveau d’étude souhaité.';
  return true;
}

function prices(){
  const p=window.KP_QUOTE_ENGINE?.getTotals();
  return {permis:Number(p?.permis)||0,complete:Number(p?.complete)||0};
}


function isSingleNewHouse(st){
  return !!(st&&st.ecran==='saisie'&&st.nature==='neuf'&&['maisons','maison'].includes(st.famille)&&Array.isArray(st.lots)&&st.lots.length===1&&st.lots[0].usage==='MI'&&Number(st.lots[0].v?.N)===1);
}

function updateHousePacksLink(){
  const screen=q('#quoteScreen');
  if(!screen)return;
  const existing=screen.querySelector('.quote-single-house');
  const st=window.KP_QUOTE_ENGINE?.getState?.();
  if(!isSingleNewHouse(st)){existing?.remove();return;}
  if(existing)return;
  const notice=document.createElement('aside');
  notice.className='quote-single-house';
  notice.innerHTML='<span class="quote-single-house-icon" aria-hidden="true"><svg viewBox="0 0 32 32" width="27" height="27" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 15 16 4l13 11M7 13v15h18V13M13 28v-9h6v9"/></svg></span><div class="quote-single-house-copy"><strong>Vous construisez une seule maison ?</strong><p>Nos packs maison individuelle à tarif forfaitaire sont adaptés à votre projet. Découvrez les différentes formules ou poursuivez votre devis ci-dessous.</p></div><a class="btn quote-single-house-link" href="/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/" data-no-signup-popup>Voir les packs maison <span aria-hidden="true">→</span></a>';
  const hero=screen.querySelector('.hero');
  if(hero)hero.after(notice);else screen.prepend(notice);
}

function tuneSaisieText(){
  const screen=q('#quoteScreen');
  if(!screen||window.KP_QUOTE_ENGINE?.getState()?.ecran!=='saisie')return;
  const lead=screen.querySelector('.hero .lede');
  if(lead)lead.textContent='Renseignez les informations concernant votre projet, puis affichez les packs disponibles.';
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
function currentBaseHt(){return Math.round(currentBaseTtc()/1.2*100)/100}
function expressSurchargeHt(){return Math.round(currentBaseHt()*.10*100)/100}
function expressSurchargeTtc(){return Math.round(expressSurchargeHt()*1.2*100)/100}
function currentTotalHt(){return Math.round((currentBaseHt()+(delivery==='express'&&expressAvailable()?expressSurchargeHt():0))*100)/100}
function currentTotalTtc(){return Math.round(currentTotalHt()*1.2*100)/100}
function finalDelay(){return delivery==='express'&&expressAvailable()?1:standardDelayDays(currentBaseTtc())}

function isBusinessField(el){return el.matches('input[data-act="valnum"],input[data-act="bat"],input[data-act="surfs"]');}
function readinessError(st,entered,fields){
  if(!entered||!st||st.ecran!=='saisie'||!st.lots?.length)return 'incomplete';
  for(const f of fields){
    const v=String(f.value??'').trim(),n=Number(v);
    if(!v||!Number.isFinite(n)||n<Number(f.min||0))return 'incomplete';
    if((['S','N','M','surfExist','sc','sj','surExist','surNeuve'].includes(f.key)||f.act==='bat'||f.act==='surfs')&&n<=0)return 'incomplete';
    if((['N','M','n','lits'].includes(f.key)||f.act==='bat'||f.act==='qte')&&!Number.isInteger(n))return 'incomplete';
  }
  for(const l of st.lots){
    const v=l.v||{};
    if((l.usage==='MI'||l.usage==='LOG'&&Number(v.N)<3)&&(!(Number(v.N)>0)||!(Number(v.M)>0)||Number(v.M)>Number(v.N)))return 'incomplete';
    if(l.usage==='COL'&&(!v.bats?.length||v.bats.some(b=>Number(typeof b==='object'?b.n:b)<3)))return 'incomplete';
  }
  return '';
}
function projectReadiness(){
  const st=window.KP_QUOTE_ENGINE?.getState?.();
  const fields=qa('#quoteScreen input[type="number"]').filter(el=>!el.closest('.final-prestation-lite')&&!el.disabled&&!el.closest('[hidden]')).map(el=>({value:el.value,min:el.min,key:el.dataset.k,act:el.dataset.act}));
  const error=readinessError(st,businessInput,fields);
  if(error)return error;
  return validateProject(st);
}
function resetCalculation(){hasCalculated=false;explicitChoice=false;chosen='permis';delivery='standard';}
function saveAccountDraft(){const form=q('[data-quote-account-form]');if(form)accountDraft=Object.fromEntries(new FormData(form));}

function addFinalChoice(){
  const screen=q('#quoteScreen');
  if(!screen||window.KP_QUOTE_ENGINE?.getState?.()?.ecran!=='saisie')return false;
  let box=screen.querySelector('.final-prestation-lite');
  const next=q('#quoteNext'),txt=q('#quoteBarTxt');
  if(next){next.hidden=true;next.disabled=true}
  const error=projectReadiness();
  if(error){
    if(box){saveAccountDraft();box.remove()}
    finalKey='';
    if(hasCalculated)resetCalculation();
    if(txt)txt.textContent=error==='incomplete'?'Complétez les informations de votre projet.':error;
    if(error.includes('RT2012')){
      let notice=screen.querySelector('.quote-manual-notice');
      if(!notice){notice=document.createElement('p');notice.className='note rouge quote-manual-notice';notice.setAttribute('role','status');screen.appendChild(notice)}
      notice.textContent=error+' ';
      const a=document.createElement('a');a.href='mailto:devis@keeplanet.fr';a.textContent='Demander un devis manuel.';notice.appendChild(a);
    }else screen.querySelector('.quote-manual-notice')?.remove();
    return false;
  }
  screen.querySelector('.quote-manual-notice')?.remove();
  if(!box){box=document.createElement('section');box.className='panel final-prestation-lite';screen.appendChild(box);finalKey=''}
  const stage=hasCalculated?'offers':'ready';
  const key=stage+'|'+explicitChoice+'|'+chosen+'|'+delivery;
  box.dataset.stage=stage;
  if(!hasCalculated){
    if(finalKey!==key){box.innerHTML=`<div class="quote-ready-content"><div class="quote-ready-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div><div><span class="quote-ready-kicker">Tout est renseigné</span><h3>Votre projet est prêt !</h3><p>Découvrez les prestations adaptées à votre projet et recevez votre devis gratuitement.</p></div></div><button type="button" class="btn btn-p quote-calculate-btn" data-act="calculate-quote"><span>Calculer mon devis</span><b aria-hidden="true">→</b></button><div class="quote-calc-note"><span>✓ Calcul immédiat</span><span>✓ Sans engagement</span></div>`;finalKey=key}
    if(txt)txt.textContent='Les informations sont complètes.';
    return true;
  }
  if(finalKey===key)return true;
  finalKey=key;
  const p=prices();
  const selected=explicitChoice;
  const previousForm=box.querySelector('[data-quote-account-form]');
  if(previousForm)accountDraft=Object.fromEntries(new FormData(previousForm));
  const delay=selected?standardDelayDays(currentBaseTtc()):0;
  if(delay<=1)delivery='standard';
  box.innerHTML=`<div class="quote-final-head"><div><span class="chip g">Votre devis</span><h3>Choisissez votre niveau d’étude</h3><p>Sélectionnez le pack adapté à votre projet. Votre devis vous sera transmis par e-mail.</p></div><span class="quote-final-step done">✓</span></div>
  <div class="opts final-presta-grid quote-two-offers">
    <button class="opt quote-offer" data-act="prestation" data-id="permis" aria-pressed="${explicitChoice&&chosen==='permis'}"><span class="tick"></span><span><strong>Pack Permis – BBIO</strong><small>Calcul Bbio et DH, attestation RE2020 pour le dépôt du permis, conseils sur l’enveloppe thermique. Cep, Cep,nr et ACV non compris.</small><i>Délai estimé : ${standardDelayDays(p.permis)} jour${standardDelayDays(p.permis)>1?'s':''} ouvré${standardDelayDays(p.permis)>1?'s':''}</i><i>Sélectionner ce pack</i></span></button>
    <button class="opt quote-offer quote-offer-mid" data-act="prestation" data-id="complete" aria-pressed="${explicitChoice&&chosen==='complete'}"><span class="quote-badge">Le plus choisi</span><span class="tick"></span><span><strong>Étude complète – RE2020</strong><small>Pack Permis inclus, Cep et Cep,nr, ACV (Ic énergie et Ic construction), résultats réglementaires utiles à l’achèvement et conseils sur les équipements.</small><i>Délai estimé : ${standardDelayDays(p.complete)} jour${standardDelayDays(p.complete)>1?'s':''} ouvré${standardDelayDays(p.complete)>1?'s':''}</i><i>Sélectionner ce pack</i></span></button>
  </div>
  <p class="quote-account-note"><strong>Prestations distinctes :</strong> l’attestation de conformité à l’achèvement des travaux, le DPE neuf, les tests de perméabilité à l’air et les contrôles de ventilation ne sont pas compris.</p>
  ${selected?`<div class="quote-public-delay"><div class="quote-public-delay-head"><strong>Délai de réalisation</strong><span>Choisissez le délai souhaité.</span></div><div class="quote-public-delay-grid"><button type="button" class="quote-delay-btn ${delivery==='standard'?'on':''}" data-quote-delivery="standard"><b>Standard</b><small>${delay} jour${delay>1?'s':''} ouvré${delay>1?'s':''}</small></button>${delay>1?`<button type="button" class="quote-delay-btn express ${delivery==='express'?'on':''}" data-quote-delivery="express"><b>Express</b><small>1 jour ouvré · +${eur(expressSurchargeTtc())} TTC</small></button>`:''}</div></div>
  <form class="quote-account-form" method="post" action="/devis-en-ligne/envoi/" data-quote-account-form>
    <input type="hidden" name="devis_payload" value="" data-quote-payload>
    <input type="hidden" name="origine" value="site-re2020">
    <input type="hidden" name="public_signup" value="1">
    <input type="hidden" name="retour_site" value="" data-return-site>
    <div class="quote-account-head"><strong>Recevez votre devis</strong><span>Si vous n’avez pas encore de compte, vos accès seront créés gratuitement.</span></div>
    <div class="quote-account-grid">
      <label><span>Nom et prénom *</span><input type="text" name="nom" autocomplete="name" required></label>
      <label><span>Société <small>(facultatif)</small></span><input type="text" name="societe" autocomplete="organization"></label>
      <label><span>E-mail *</span><input type="email" name="email" autocomplete="email" required></label>
      <label><span>Téléphone <small>(facultatif)</small></span><input type="tel" name="telephone" autocomplete="tel"></label>
      <label class="wide quote-address-field"><span>Adresse *</span><div class="quote-address-wrap"><input type="text" name="adresse" autocomplete="off" aria-autocomplete="list" aria-expanded="false" data-address-autocomplete required><div class="quote-address-suggestions" data-address-suggestions hidden></div></div></label>
      <label><span>Code postal *</span><input type="text" name="code_postal" inputmode="numeric" autocomplete="postal-code" required></label>
      <label><span>Ville *</span><input type="text" name="ville" autocomplete="address-level2" required></label>
    </div>
    <button type="submit" class="btn btn-p quote-send-btn" data-no-signup-popup>M’envoyer le devis et créer mon compte gratuitement</button>
    <p class="quote-account-note">Aucun paiement à cette étape. Si vous avez déjà un compte, le parcours existant vous permet de le retrouver.</p>
  </form>`:''}`;
  {const form=box.querySelector('[data-quote-account-form]');if(form)for(const [key,value] of Object.entries(accountDraft)){const input=form.elements.namedItem(key);if(input&&input.type!=='hidden')input.value=value}}
  if(next){
    next.hidden=true;
    next.disabled=true;
    next.textContent='Choisissez votre pack';
  }
  if(txt)txt.innerHTML=explicitChoice?`Délai : <b>${finalDelay()} jour${finalDelay()>1?'s':''} ouvré${finalDelay()>1?'s':''}</b>`:'Sélectionnez un pack pour continuer.';
  return true;
}

// Contrat V32 : le compte est résolu côté serveur, jamais via un identifiant fourni par le visiteur.
function canonicalProject(st){
  const fam=f=>f==='maisons'?'maison':f||'';
  const family=fam(st.famille),ext=fam(st.familleExt),neuf=fam(st.familleNeuf),parts={},normalized=[];
  const groups=st.nature==='mixte-ne'?[['ext',ext],['neuf',neuf]]:[[st.nature==='sur'?'sur':['ext','reno-ext'].includes(st.nature)?'ext':'main',family]];
  for(const [role,f] of groups){
    const ls=st.nature==='mixte-ne'?st.lots.filter(l=>role==='ext'?['ext','ext-agr','ext-log'].includes(l.role):l.role==='neuf'):st.lots;
    const agr=ls.find(l=>l.usage==='EXT'),mi=ls.find(l=>l.usage==='MI'),col=ls.find(l=>l.usage==='COL'),cols=ls.find(l=>l.usage==='COLS');
    const bats=l=>(l?.v?.bats||[]).map(b=>({n:Number(b.n),same:b.same===''||b.same==null?'':Number(b.same)}));
    const zone=l=>{const v={...l.v};if(l.usage==='COL'){const b=bats(l);v.bats=b.map(x=>x.n);v.same=b.map(x=>x.same===''?null:x.same)}if(role==='sur')v.S=Number(st.surNeuve);return{usage:l.usage,v,qte:Number(l.qte)||1}};
    parts[role]=f==='maison'?{N:mi?.v.N??'',M:mi?.v.M??'',extAgrSurface:agr?.v.S??'',extSurfNouveaux:role==='ext'?mi?.v.S??'':''}:f==='collectif'?{bats:bats(col),colN:cols?.v.N??'',extAgrSurface:agr?.v.S??''}:{zones:ls.map(zone)};
    for(const l of ls){const z=zone(l);normalized.push({...z,role:['ext-agr','ext-log'].includes(l.role)?l.role:role==='main'?(f==='maison'||f==='collectif'?'main':'neuf'):role})}
  }
  return{nature:st.nature,famille:family,famille_extension:ext,famille_neuve:neuf,usage:null,donnees:{projectName:st.nom||'',extMode:st.extMode,surExist:st.surExist,surNeuve:st.surNeuve,parts},lots:normalized};
}
function validateProject(st){
  if(!st||!st.lots.length)return 'Complétez les informations de votre projet.';
  if(!String(st.nom||'').trim())return 'Indiquez le nom ou la référence du projet.';
  const pr=canonicalProject(st),d=pr.donnees,positive=x=>Number(x)>0,whole=(x,min)=>Number.isInteger(Number(x))&&Number(x)>=min&&x!=='';
  if(st.nature==='mixte-ne'&&(!pr.famille_extension||!pr.famille_neuve))return 'Sélectionnez les deux types de bâtiment.';
  if(st.nature==='sur'&&(!['collectif','tertiaire'].includes(pr.famille)||!positive(d.surExist)||!positive(d.surNeuve)))return 'Renseignez les deux surfaces de la surélévation.';
  if(['ext','reno-ext'].includes(st.nature)&&pr.famille==='mixte')return 'Pour une extension à usages mixtes, contactez notre équipe.';
  for(const [role,p] of Object.entries(d.parts)){
    if(p.zones&&p.zones.length>30)return 'Limitez le projet à 30 zones ou contactez notre équipe.';
    if('colN'in p&&role==='sur'&&!whole(p.colN,1))return 'Renseignez le nombre de logements créés.';
    if(p.zones&&!p.zones.length)return 'Renseignez au moins un usage pour chaque partie du projet.';
    if(role==='ext'&&'N'in p&&d.extMode!=='agrandissement'&&!positive(p.extSurfNouveaux))return 'Renseignez la surface des nouveaux logements.';
    if(role==='ext'&&'extAgrSurface'in p&&d.extMode!=='nouveaux'&&!positive(p.extAgrSurface))return 'Renseignez la surface agrandie.';
    if('colN'in p&&role==='ext'&&d.extMode!=='agrandissement'&&!whole(p.colN,1))return 'Renseignez les logements supplémentaires.';
    if('N'in p&&(role!=='ext'||d.extMode!=='agrandissement')&&(!whole(p.N,1)||!whole(p.M,1)||Number(p.M)>Number(p.N)))return 'Renseignez le nombre de logements et de modèles.';
    if('bats'in p&&role!=='ext'&&role!=='sur'&&!p.bats.length)return 'Renseignez les bâtiments collectifs.';
  }
  const small=['UNI','HOT','SAN','VEN','IND','FOY','RES','SPO','HOP','CRE'];
  for(const l of pr.lots){
    const v=l.v,u=l.usage;
    if(!whole(l.qte,1)||l.qte>100)return 'Quantité de bâtiments invalide.';
    if(u==='EXT'&&!positive(v.S))return 'Renseignez la surface agrandie.';
    if(['MI','LOG','COLS'].includes(u)&&!whole(v.N,1))return 'Renseignez le nombre de logements.';
    if((u==='MI'||u==='LOG'&&Number(v.N)<3)&&(!whole(v.M,1)||Number(v.M)>Number(v.N)))return 'Renseignez un nombre de modèles valide (au plus le nombre de logements).';
    if(u==='COL'&&(!v.bats.length||v.bats.length>6||v.bats.some((n,i)=>!whole(n,3)||(v.same[i]!=null&&(!whole(v.same[i],0)||v.same[i]>=i||v.bats[v.same[i]]!==n)))))return 'Vérifiez les logements et les bâtiments identiques.';
    if(!['EXT','MI','LOG','COL','COLS'].includes(u)){
      if(!(u==='FOY'&&v.cuisine==='individuelle')&&!positive(v.S))return 'Renseignez une surface supérieure à zéro.';
      if(u==='FOY'&&!['aucun','commun','individuelle'].includes(v.cuisine))return 'Précisez le type de cuisine du foyer.';
      if(u==='FOY'&&v.cuisine==='individuelle'&&!whole(v.n,1))return 'Renseignez le nombre de chambres.';
      if(u==='UNI'&&!['oui','non'].includes(v.amphi))return 'Précisez si un amphithéâtre est prévu.';
      if(u==='HOP'&&(!positive(v.sc)||!positive(v.sj)))return 'Renseignez les surfaces de chambre et de consultation.';
      if(['BUR','ENS','UNI','SAN','VEN','IND','SPO','HOP','CRE','VES'].includes(u)&&!['oui','non'].includes(v.resto))return 'Précisez si une zone de restauration est prévue.';
      if(l.role==='neuf'&&!['oui','non'].includes(v.coqueBrute))return 'Précisez si le bâtiment est livré en coque brute.';
      if(l.role==='ext'&&small.includes(u)&&!positive(v.surfExist))return 'Renseignez la surface du bâtiment existant.';
      if(l.role==='neuf'&&small.includes(u)&&!(u==='FOY'&&v.cuisine==='individuelle')&&Number(v.S)<=50)return 'Cette petite surface nécessite un devis manuel RT2012. Contactez notre équipe.';
    }
  }
  return '';
}
function publicPayload(){
  const st=window.KP_QUOTE_ENGINE?.getState();
  if(validateProject(st)||!explicitChoice)return null;
  const p=prices(),totalTtc=currentTotalTtc(),express=delivery==='express'&&expressAvailable();
  if(!(currentBaseTtc()>0)||!Number.isFinite(totalTtc))return null;
  return {version:'site-public-v32-denis-20260918',origine:'r-e-2020.fr',reference:st.ref||'',date:new Date().toISOString(),projet:canonicalProject(st),reglementation:'RE2020',prestation:chosen==='complete'?'complete':'bbio',delai:{mode:delivery,jours_ouvres:finalDelay(),express,surcout_ht:express?expressSurchargeHt():0,surcout_ttc:express?expressSurchargeTtc():0},facturation:'account',prix:{bbio_ttc:p.permis,bbio_ht:p.permis/1.2,complete_ttc:p.complete,complete_ht:p.complete/1.2,express_majoration_pct:express?10:0,total_ttc:totalTtc,total_ht:currentTotalHt()}};
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
  updateHousePacksLink();
  addFinalChoice();
  removeStrayPrices();
  addProgress();
  root.classList.add('devis-lite-site');
}

// Capture the final actions before the engine's delegated click handler.
root.addEventListener('click',e=>{
  const b=e.target.closest('[data-act="calculate-quote"],.final-prestation-lite [data-act="prestation"],[data-quote-delivery]');
  if(!b)return;
  e.preventDefault();e.stopImmediatePropagation();
  if(calculating)return;
  saveAccountDraft();
  if(b.dataset.act==='calculate-quote'){
    if(projectReadiness())return;
    resetCalculation();showLoader();b.disabled=true;
    setTimeout(()=>{
      hasCalculated=!projectReadiness();
      hideLoader();
      addFinalChoice();addProgress();
      const box=q('.final-prestation-lite');
      if(box&&hasCalculated)box.scrollIntoView({behavior:'smooth',block:'center'});
    },650);
    return;
  }
  if(b.dataset.act==='prestation'){
    explicitChoice=true;chosen=b.dataset.id;delivery='standard';
    addFinalChoice();addProgress();
    q('.quote-public-delay')?.scrollIntoView({behavior:'smooth',block:'nearest'});
  }else{
    delivery=b.dataset.quoteDelivery==='express'?'express':'standard';
    addFinalChoice();
  }
},true);
root.addEventListener('click',e=>{
  if(e.target.closest('[data-quote-account-form]')||e.target.closest('select,input,textarea'))return;
  const b=e.target.closest('[data-act]');
  if(!b||calculating)return;
  const act=b.dataset.act;
  if(['nature','famille','restart'].includes(act))businessInput=false;
  if(act==='restart')accountDraft={};
  if(['nature','famille','mixfam','mixusage','mixadd','extmode','usage','autreusage','addlot','dellot','compo','val','addbat','delbat','restart','goto','moa'].includes(act)){
    resetCalculation();finalKey='';
  }
  scheduleTune();
});
root.addEventListener('input',e=>{
  if(e.target.closest('[data-quote-account-form]'))return;
  if(e.target.closest('.lot')||e.target.matches('[data-act="surfs"],[data-act="projectname"]')){
    if(isBusinessField(e.target))businessInput=true;
    resetCalculation();
    // The engine already updated the state. Do not replace the ready button on every keystroke.
    updateHousePacksLink();addFinalChoice();addProgress();
  }
});
root.addEventListener('change',e=>{
  if(e.target.closest('[data-quote-account-form]'))return;
  // Numeric and text input were processed on input. A blur must not destroy
  // the button which the visitor is about to click.
  if(!e.target.matches('select'))return;
  if(e.target.closest('.lot')){
    resetCalculation();finalKey='';scheduleTune();
  }
});
let addressTimer=0;
let addressAbort=null;

function closeAddressSuggestions(input){
  const wrap=input&&input.closest('.quote-address-wrap');
  const list=wrap&&wrap.querySelector('[data-address-suggestions]');
  if(list){list.hidden=true;list.innerHTML='';}
  if(input)input.setAttribute('aria-expanded','false');
}

function addressLineFromResult(r){
  const full=String(r.fulltext||r.label||r.street||'').trim();
  const zip=String(r.zipcode||((r.zipcodes||[])[0])||'').trim();
  const city=String(r.city||'').trim();
  if(!full)return '';
  const suffix=zip&&city?', '+zip+' '+city:'';
  if(suffix&&full.toLowerCase().endsWith(suffix.toLowerCase()))return full.slice(0,-suffix.length).trim();
  return full;
}

function renderAddressSuggestions(input,results){
  const wrap=input.closest('.quote-address-wrap');
  const list=wrap&&wrap.querySelector('[data-address-suggestions]');
  if(!list)return;
  const rows=Array.isArray(results)?results.slice(0,6):[];
  if(!rows.length){closeAddressSuggestions(input);return;}
  list.innerHTML=rows.map((r,i)=>{
    const full=String(r.fulltext||r.label||r.street||'').trim();
    const safe=full.replace(/[&<>"']/g,ch=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[ch]));
    return '<button type="button" data-address-choice="'+i+'">'+safe+'</button>';
  }).join('');
  list._results=rows;
  list.hidden=false;
  input.setAttribute('aria-expanded','true');
}

root.addEventListener('input',e=>{
  const input=e.target.closest('[data-address-autocomplete]');
  if(!input)return;
  clearTimeout(addressTimer);
  if(addressAbort){addressAbort.abort();addressAbort=null;}
  const query=input.value.trim();
  if(query.length<3){closeAddressSuggestions(input);return;}
  addressTimer=setTimeout(async()=>{
    addressAbort=new AbortController();
    try{
      const url='https://data.geopf.fr/geocodage/completion/?text='+encodeURIComponent(query)+'&type=StreetAddress&maximumResponses=6';
      const response=await fetch(url,{signal:addressAbort.signal,headers:{'Accept':'application/json'}});
      if(!response.ok)throw new Error('address api');
      const data=await response.json();
      renderAddressSuggestions(input,data&&Array.isArray(data.results)?data.results:[]);
    }catch(err){
      if(err&&err.name==='AbortError')return;
      closeAddressSuggestions(input);
    }
  },280);
},true);

root.addEventListener('click',e=>{
  const choice=e.target.closest('[data-address-choice]');
  if(!choice)return;
  const list=choice.closest('[data-address-suggestions]');
  const wrap=choice.closest('.quote-address-wrap');
  const input=wrap&&wrap.querySelector('[data-address-autocomplete]');
  const form=choice.closest('[data-quote-account-form]');
  const results=(list&&list._results)||[];
  const r=results[Number(choice.dataset.addressChoice)];
  if(!input||!r)return;
  input.value=addressLineFromResult(r);
  const zip=form&&form.querySelector('[name="code_postal"]');
  const city=form&&form.querySelector('[name="ville"]');
  if(zip)zip.value=String(r.zipcode||((r.zipcodes||[])[0])||'');
  if(city)city.value=String(r.city||'');
  closeAddressSuggestions(input);
},true);

document.addEventListener('click',e=>{
  const input=root.querySelector('[data-address-autocomplete]');
  if(input&&!e.target.closest('.quote-address-wrap'))closeAddressSuggestions(input);
});

root.addEventListener('submit',e=>{
  const form=e.target.closest('[data-quote-account-form]');
  if(!form)return;

  const requiredNames=['nom','email','adresse','code_postal','ville'];
  let firstInvalid=null;
  requiredNames.forEach(name=>{
    const input=form.querySelector('[name="'+name+'"]');
    if(!input)return;
    const empty=!String(input.value||'').trim();
    input.setCustomValidity(empty?'Ce champ est obligatoire.':'');
    input.toggleAttribute('aria-invalid',empty);
    if(empty&&!firstInvalid)firstInvalid=input;
  });
  const email=form.querySelector('[name="email"]');
  if(email&&String(email.value||'').trim()&&!email.validity.valid){
    if(!firstInvalid)firstInvalid=email;
  }
  if(firstInvalid||!form.checkValidity()){
    e.preventDefault();
    form.reportValidity();
    (firstInvalid||form.querySelector(':invalid'))?.focus();
    return;
  }

  if(projectReadiness()||!hasCalculated||!explicitChoice){e.preventDefault();return;}
  const payload=publicPayload();
  if(!payload){
    e.preventDefault();
    const notice=document.createElement('p');notice.className='note rouge';notice.setAttribute('role','alert');notice.textContent='Le projet a changé. Vérifiez les informations et recalculez votre devis.';form.appendChild(notice);
    return;
  }
  const fd=new FormData(form);
  payload.coordonnees_compte={
    firstName:String(fd.get('nom')||'').trim(),
    lastName:'',
    company:String(fd.get('societe')||'').trim(),
    email:String(fd.get('email')||'').trim(),
    phone:String(fd.get('telephone')||'').trim(),
    address:String(fd.get('adresse')||'').trim(),
    zip:String(fd.get('code_postal')||'').trim(),
    city:String(fd.get('ville')||'').trim()
  };
  const hidden=form.querySelector('[data-quote-payload]');
  if(hidden)hidden.value=JSON.stringify(payload);
  const returnSite=form.querySelector('[data-return-site]');
  if(returnSite)returnSite.value=window.location.origin;
  const submit=form.querySelector('button[type="submit"]');
  if(submit){submit.disabled=true;submit.textContent='Création du devis en cours…';}
},true);

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