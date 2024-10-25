window.addEventListener("load",function(){new Z4M_ThemeChooser()});class Z4M_ThemeChooser{#userPanelId='zdk-userpanel-modal'
#appLogoSelector='#zdk-company-logo img'
#themeButtonClass='choosetheme'
#selectThemeButtonClass='select-theme'
#themeChooserViewName='z4m_theme_chooser'
#themeChooserModalId='z4m-theme-chooser'
#themeTransitionClass='z4m-theme-chooser-transition'
constructor(){if(z4m.authentication.isEnabled()&&!z4m.authentication.isRequired()){this.#addDisplayButtonInUserPanel();this.#handleClickButtonInUserPanel()}}
#addDisplayButtonInUserPanel(){const myUserRightsButton=document.querySelector('#'+this.#userPanelId+' button.myuserrights');const themeButton=document.querySelector('#z4m-theme-chooser-extra-code > button');myUserRightsButton.after(themeButton);document.querySelector('#z4m-theme-chooser-extra-code').remove()}
#handleClickButtonInUserPanel(){const $this=this;const themeButton=document.querySelector('#'+this.#userPanelId+' button.'+this.#themeButtonClass);themeButton.addEventListener('click',function(){$this.#showThemeChooserDialog()})}
#showThemeChooserDialog(){const $this=this;const userPanelObj=z4m.modal.make('#'+this.#userPanelId);const doesModalExistInDom=document.getElementById(this.#themeChooserModalId)!==null;z4m.modal.make('#'+this.#themeChooserModalId,this.#themeChooserViewName,function(){userPanelObj.close();$this.#addCheckIconToThemeButtons();this.open();if(!doesModalExistInDom){this.element[0].addEventListener('click',function(event){const clickedButton=event.target.closest('button');if(clickedButton&&clickedButton.classList.contains($this.#selectThemeButtonClass)){$this.#selectTheme(clickedButton.dataset.css,clickedButton.dataset.fileversion,clickedButton.dataset.theme,clickedButton.dataset.icon)}})}})}
#closeThemeChooserDialog(){const modal=z4m.modal.make('#'+this.#themeChooserModalId);modal.close()}
#getThemeButtons(){return document.querySelectorAll('#'+this.#themeChooserModalId+' button.'+this.#selectThemeButtonClass)}
#addCheckIconToThemeButtons(){const selectedThemeName=this.#getSelectedThemeLink(!0);const buttons=this.#getThemeButtons();for(let i=0;i<buttons.length;++i){let button=buttons[i];let themeName=button.dataset.theme;let checkIcon=button.querySelector('i.fa-check');if(themeName===selectedThemeName){checkIcon.classList.remove('w3-hide');button.disabled=!0}else{checkIcon.classList.add('w3-hide');button.disabled=!1}}}
#getSelectedThemeLink(returnThemeName){const buttons=this.#getThemeButtons();for(let i=0;i<buttons.length;++i){let button=buttons[i];let css=button.dataset.css;let themeLink=$('link[href*="'+css+'"]');if(themeLink.length>0){return returnThemeName===!0?button.dataset.theme:themeLink}}
return!1}
#getAppLogo(){return $(this.#appLogoSelector)}
#selectTheme(css,fileversion,themeName,iconPath){const $this=this;this.#storeNewThemeForUser(themeName,function(){$this.#closeThemeChooserDialog();$this.#applyTheme(css+'?v='+fileversion,themeName);if(iconPath!==undefined){$this.#getAppLogo().attr('src',iconPath)}})}
#applyTheme(newThemePath,themeName,onSuccess,onError){const $this=this,currentThemeLinkEl=this.#getSelectedThemeLink(),newThemeLink=$('<link rel="stylesheet" type="text/css"/>');newThemeLink[0].onload=function(){currentThemeLinkEl.remove();$this.#applyThemeTransition(!1);$('body').attr('data-theme',themeName);if(typeof onSuccess==='function'){onSuccess()}};newThemeLink[0].onerror=function(){$this.#applyThemeTransition(!1);if(typeof onError==='function'){onError()}};$this.#applyThemeTransition(!0);newThemeLink.attr('href',newThemePath);currentThemeLinkEl.after(newThemeLink)}
#applyThemeTransition(start){const transitionClass=this.#themeTransitionClass;if(start){z4m.ajax.toggleLoader(!0);document.documentElement.classList.add(transitionClass)}else{z4m.ajax.toggleLoader(!1);window.setTimeout(function(){document.documentElement.classList.remove(transitionClass)},2000)}}
#storeNewThemeForUser(themeName,successCallback){const modal=z4m.modal.make('#'+this.#themeChooserModalId);z4m.ajax.request({controller:'Z4mThemeChooserCtrl',action:'store',data:{new_theme:themeName},callback:function(response){modal.getInnerForm().hideError();if(response.success){successCallback();z4m.messages.showSnackbar(response.msg)}else{modal.getInnerForm().showError(response.msg)}}})}}