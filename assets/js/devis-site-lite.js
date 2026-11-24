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

function tuneSaisieText(){
  const screen=q('#quoteScreen');
  if(!screen||!screen.querySelector('.lot'))return;
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
function expressSurchargeHt(){return Math.round(currentBaseTtc()/1.2*.10*100)/100}
function expressSurchargeTtc(){return Math.round(currentBaseTtc()*.10*100)/100}
function currentTotalTtc(){return Math.round((currentBaseTtc()+(delivery==='express'&&expressAvailable()?expressSurchargeHt()*1.2:0))*100)/100}
function finalDelay(){return delivery==='express'&&expressAvailable()?1:standardDelayDays(currentBaseTtc())}

function addFinalChoice(){
  const screen=q('#quoteScreen');
  if(!screen||window.KP_QUOTE_ENGINE?.getState()?.ecran!=='saisie')return false;
  let box=screen.querySelector('.final-prestation-lite');
  if(!box){box=document.createElement('section');box.className='panel final-prestation-lite';screen.appendChild(box)}
  const next=q('#quoteNext');
  const txt=q('#quoteBarTxt');
  if(!hasCalculated){
    box.innerHTML=`<div class="quote-final-head"><div><span class="chip o">Dernière étape</span><h3>Votre projet est prêt</h3><p>Vérifiez les informations avant d’afficher les packs.</p></div><span class="quote-final-step">3/3</span></div><button type="button" class="btn btn-p quote-calculate-btn" data-act="calculate-quote"><span>Afficher les packs disponibles</span><b aria-hidden="true">→</b></button><div class="quote-calc-note"><span>✓ Calcul immédiat</span><span>✓ Sans engagement</span></div>`;
    if(next){next.disabled=true;next.textContent='Calculez d’abord votre devis'}
    if(txt)txt.textContent='Terminez votre saisie puis calculez votre devis.';
    return true;
  }
  const p=prices();
  const selected=explicitChoice;
  const previousForm=box.querySelector('[data-quote-account-form]');
  if(previousForm)accountDraft=Object.fromEntries(new FormData(previousForm));
  const delay=selected?standardDelayDays(currentBaseTtc()):0;
  if(delay<=1)delivery='standard';
  box.innerHTML=`<div class="quote-final-head"><div><span class="chip g">Votre devis</span><h3>Choisissez votre niveau d’étude</h3><p>Sélectionnez le pack adapté à votre projet. Votre devis vous sera transmis par e-mail.</p></div><span class="quote-final-step done">✓</span></div>
  <div class="opts final-presta-grid quote-two-offers">
    <button class="opt quote-offer" data-act="prestation" data-id="permis" aria-pressed="${explicitChoice&&chosen==='permis'}"><span class="tick"></span><span><strong>Pack Permis – BBIO</strong><small>Calcul Bbio et DH, attestation RE2020 pour le dépôt du permis, conseils sur l’enveloppe thermique. Cep, Cep,nr et ACV non compris.</small><i>Délai estimé : ${standardDelayDays(p.permis)} jour(s) ouvré(s)</i><i>Sélectionner ce pack</i></span></button>
    <button class="opt quote-offer quote-offer-mid" data-act="prestation" data-id="complete" aria-pressed="${explicitChoice&&chosen==='complete'}"><span class="quote-badge">Le plus choisi</span><span class="tick"></span><span><strong>Étude complète – RE2020</strong><small>Pack Permis inclus, Cep et Cep,nr, ACV (Ic énergie et Ic construction), résultats réglementaires utiles à l’achèvement et conseils sur les équipements.</small><i>Délai estimé : ${standardDelayDays(p.complete)} jour(s) ouvré(s)</i><i>Sélectionner ce pack</i></span></button>
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
    next.hidden=!!explicitChoice;
    next.disabled=!explicitChoice;
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
  return {version:'site-public-v32-denis-20260918',origine:'r-e-2020.fr',reference:st.ref||'',date:new Date().toISOString(),projet:canonicalProject(st),reglementation:'RE2020',prestation:chosen==='complete'?'complete':'bbio',delai:{mode:delivery,jours_ouvres:finalDelay(),express,surcout_ht:expressSurchargeHt(),surcout_ttc:express?expressSurchargeTtc():0},facturation:'account',prix:{bbio_ttc:p.permis,bbio_ht:p.permis/1.2,complete_ttc:p.complete,complete_ht:p.complete/1.2,express_majoration_pct:express?10:0,total_ttc:totalTtc,total_ht:totalTtc/1.2}};
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

root.addEventListener('click',e=>{const form=q('[data-quote-account-form]');if(form)accountDraft=Object.fromEntries(new FormData(form));},true);
root.addEventListener('click',e=>{
  if(e.target.closest('[data-quote-account-form]'))return;
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
    const error=validateProject(window.KP_QUOTE_ENGINE?.getState());
    if(error){const box=q('.final-prestation-lite');let notice=box?.querySelector('.quote-validation-error');if(!notice&&box){notice=document.createElement('p');notice.className='note rouge quote-validation-error';notice.setAttribute('role','alert');box.appendChild(notice)}if(notice)notice.textContent=error;return;}
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
  if(['nature','famille','mixfam','mixusage','mixadd','extmode','usage','autreusage','addlot','dellot','compo','val','addbat','delbat','restart','goto'].includes(b.dataset.act)){hasCalculated=false;explicitChoice=false;chosen='permis';delivery='standard'}
  scheduleTune();
});

root.addEventListener('input',e=>{
  if(e.target.closest('[data-quote-account-form]'))return;
  if(e.target.closest('.lot')||e.target.matches('[data-act="surfs"],[data-act="projectname"]')){
    hasCalculated=false;
    explicitChoice=false;
    chosen='permis';
    delivery='standard';

    /*
     * Les champs numériques du moteur mettent déjà à jour l'état et
     * le chiffrage. On ne reconstruit jamais l'écran pendant leur saisie :
     * cela évite le clignotement du texte/caret, notamment sur les maisons.
     *
     * Seul le bloc final est remis en état "à recalculer", sans toucher
     * aux inputs ni à leur focus.
     */
    if(e.target.matches('input[type="number"]')){
      addFinalChoice();
      return;
    }
    scheduleTune(90);
  }
});
root.addEventListener('change',e=>{
  if(e.target.closest('[data-quote-account-form]'))return;
  if(e.target.closest('.lot')||e.target.matches('[data-act="surfs"],[data-act="projectname"]')){
    hasCalculated=false;
    explicitChoice=false;
    chosen='permis';
    delivery='standard';

    /*
     * Même règle au change : un input numérique ne doit jamais provoquer
     * de rerender global (les flèches natives des champs number déclenchent
     * aussi change sur certains navigateurs).
     */
    if(e.target.matches('input[type="number"]')){
      addFinalChoice();
      return;
    }
    scheduleTune();
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