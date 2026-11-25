(function(){
'use strict';
const page=location.pathname;
const housePage='/tarifs-etude-thermique-re-2020/maison-individuelle-extensions/';
const dialog=document.getElementById('kp-house-dialog');
const info=document.getElementById('kp-house-pack-data');
let packs={};try{packs=info?JSON.parse(info.textContent):{}}catch(_){}
let trigger=null;
const allowedPacks=['eco','permis','fdc','fdc-acv','inf50'];
function emit(event, fields={}){
  // Only coarse non-personal events. No form data, email, name, identifiers or UTM strings.
  window.dataLayer=window.dataLayer||[];
  window.dataLayer.push(Object.assign({event},fields));
  if(window.KP_CONVERSION_AGGREGATE===true){try{fetch("/api/conversion-metrics.php",{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify(Object.assign({event},fields)),credentials:"same-origin",keepalive:true}).catch(()=>{});}catch(_){}}
}
const route=page==='/'?'home':page===housePage?'packs':page==='/tarifs-etude-thermique-re-2020/'?'tarifs':page==='/devis-en-ligne/'?'devis':page==='/professionnels-du-batiment/'?'pro':page==='/inscription-maison/'?'inscription':'other';
if(route!=='other')emit('kp_page_view',{kp_route:route});
if(route==='packs')emit('kp_packs_view');
if(route==='devis')emit('kp_quote_view');
if(route==='inscription'){const p=new URLSearchParams(location.search).get('pack');if(allowedPacks.includes(p))emit('kp_signup_start',{kp_pack:p,kp_method:'page'});}
function showPack(link){
  const pack=link.dataset.housePack;
  if(!dialog||typeof dialog.showModal!=='function'||!packs[pack])return false;
  const p=packs[pack],form=dialog.querySelector('form');
  if(!form)return false;
  dialog.querySelector('[data-house-label]').textContent=p.label;
  dialog.querySelector('[data-house-desc]').textContent=p.description;
  dialog.querySelector('[data-house-price]').textContent=p.price;
  form.elements.pack.value=pack;
  form.elements.offre_maison.value='0';
  form.elements.retour_site.value=location.origin;
  dialog.querySelector('.kp-house-fallback').href='/inscription-maison/';
  trigger=link;
  try{dialog.showModal();}catch(_){return false;}
  document.documentElement.classList.add('kp-house-dialog-open');
  emit('kp_signup_start',{kp_pack:pack,kp_method:'modal'});
  return true;
}
if(dialog){
  dialog.querySelector('[data-house-dialog-close]').addEventListener('click',()=>dialog.close());
  dialog.addEventListener('click',e=>{if(e.target===dialog)dialog.close()});
  dialog.addEventListener('close',()=>{document.documentElement.classList.remove('kp-house-dialog-open');trigger?.focus()});
}
document.addEventListener('click',e=>{
  const link=e.target.closest('a,button');if(!link)return;
  if(link.dataset.housePack&&allowedPacks.includes(link.dataset.housePack)){
    emit('kp_pack_click',{kp_pack:link.dataset.housePack});
    if(!e.ctrlKey&&!e.metaKey&&!e.shiftKey&&!e.altKey&&e.button===0&&showPack(link)){e.preventDefault();e.stopImmediatePropagation();}
    return;
  }
  if(link.matches('[data-house-exit-claim]'))emit('kp_exit_offer_claim');
  if(link.dataset.croDoc)emit('kp_document_click',{kp_document:link.dataset.croDoc});
  if(link.matches('[data-act="calculate-quote"]'))emit('kp_quote_calculate_click');
  if(link.matches('.final-prestation-lite [data-act="prestation"]')&&['permis','complete','fdc'].includes(link.dataset.id))emit('kp_quote_pack_click',{kp_pack:link.dataset.id});
  if(link.getAttribute('href')==='/professionnels-du-batiment/')emit('kp_pro_click');
},true);
document.addEventListener('submit',e=>{
  const form=e.target;if(!form.matches('[data-house-signup-form],[data-quote-account-form]')||!form.checkValidity())return;
  if(form.matches('[data-house-signup-form]')){const p=form.elements.pack?.value;if(allowedPacks.includes(p))emit('kp_signup_submit_attempt',{kp_pack:p,kp_method:dialog?.contains(form)?'modal':'page',kp_offer:Number(form.elements.offre_maison?.value)>0?'yes':'no'});}
  else emit('kp_quote_submit_attempt');
},true);
const offer=document.querySelector('[data-house-exit-offer]');
if(offer){let shown=false;new MutationObserver(()=>{if(!shown&&!offer.hidden){shown=true;emit('kp_exit_offer_shown')}}).observe(offer,{attributes:true,attributeFilter:['hidden']});}
})();