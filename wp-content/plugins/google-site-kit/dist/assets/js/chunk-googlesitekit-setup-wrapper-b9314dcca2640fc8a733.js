(window.__googlesitekit_webpackJsonp=window.__googlesitekit_webpackJsonp||[]).push([[5],{173:function(e,t,n){"use strict";(function(e,i){var r=n(6),a=n.n(r),o=n(16),l=n.n(o),c=n(7),u=n.n(c),s=n(8),d=n.n(s),m=n(23),p=n.n(m),f=n(9),g=n.n(f),h=n(10),v=n.n(h),y=n(4),_=n.n(y),k=n(1),E=n(0),b=n(11),R=n.n(b),S=n(5),M=n(110),N=n(46),C=n(174),O=n(119),D=n(29),w=n(22);function j(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,i=_()(e);if(t){var r=_()(this).constructor;n=Reflect.construct(i,arguments,r)}else n=i.apply(this,arguments);return v()(this,n)}}var U=R.a.withSelect,x=function(t){g()(UserMenu,t);var n,r=j(UserMenu);function UserMenu(e){var t;return u()(this,UserMenu),(t=r.call(this,e)).state={dialogActive:!1,menuOpen:!1},t.handleMenu=t.handleMenu.bind(p()(t)),t.handleMenuClose=t.handleMenuClose.bind(p()(t)),t.handleMenuItemSelect=t.handleMenuItemSelect.bind(p()(t)),t.handleDialog=t.handleDialog.bind(p()(t)),t.handleDialogClose=t.handleDialogClose.bind(p()(t)),t.handleUnlinkConfirm=t.handleUnlinkConfirm.bind(p()(t)),t.menuButtonRef=Object(k.i)(),t.menuRef=Object(k.i)(),t}return d()(UserMenu,[{key:"componentDidMount",value:function(){e.addEventListener("mouseup",this.handleMenuClose),e.addEventListener("keyup",this.handleMenuClose),e.addEventListener("keyup",this.handleDialogClose)}},{key:"componentWillUnmount",value:function(){e.removeEventListener("mouseup",this.handleMenuClose),e.removeEventListener("keyup",this.handleMenuClose),e.removeEventListener("keyup",this.handleDialogClose)}},{key:"handleMenu",value:function(){var e=this.state.menuOpen;this.setState({menuOpen:!e})}},{key:"handleMenuClose",value:function(e){("keyup"!==e.type||27!==e.keyCode)&&"mouseup"!==e.type||this.menuButtonRef.current.buttonRef.current.contains(e.target)||this.menuRef.current.menuRef.current.contains(e.target)||this.setState({menuOpen:!1})}},{key:"handleMenuItemSelect",value:function(t,n){var i=this.props.proxyPermissionsURL;if("keydown"===n.type&&(13===n.keyCode||32===n.keyCode)||"click"===n.type)switch(t){case 0:this.handleDialog();break;case 1:if(!i)return;e.location.assign(i);break;default:this.handleMenu()}}},{key:"handleDialog",value:function(){this.setState((function(e){return{dialogActive:!e.dialogActive,menuOpen:!1}}))}},{key:"handleDialogClose",value:function(e){27===e.keyCode&&this.setState({dialogActive:!1,menuOpen:!1})}},{key:"handleUnlinkConfirm",value:(n=l()(a.a.mark((function e(){return a.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:this.setState({dialogActive:!1}),Object(S.c)(),document.location=Object(S.l)("googlesitekit-splash",{googlesitekit_context:"revoked"});case 3:case"end":return e.stop()}}),e,this)}))),function(){return n.apply(this,arguments)})},{key:"render",value:function(){var e=this.props,t=e.proxyPermissionsURL,n=e.userEmail,r=e.userPicture,a=this.state,o=a.dialogActive,l=a.menuOpen;return n?i.createElement(k.b,null,i.createElement("div",{className:"googlesitekit-dropdown-menu mdc-menu-surface--anchor"},i.createElement(N.a,{ref:this.menuButtonRef,className:"googlesitekit-header__dropdown mdc-button--dropdown",text:!0,onClick:this.handleMenu,icon:r?i.createElement("i",{className:"mdc-button__icon","aria-hidden":"true"},i.createElement("img",{className:"mdc-button__icon--image",src:r,alt:Object(E.__)("User Avatar","google-site-kit")})):void 0,ariaHaspopup:"menu",ariaExpanded:l,ariaControls:"user-menu"},n),i.createElement(C.a,{ref:this.menuRef,menuOpen:l,menuItems:[Object(E.__)("Disconnect","google-site-kit")].concat(t?[Object(E.__)("Manage sites…","google-site-kit")]:[]),onSelected:this.handleMenuItemSelect,id:"user-menu"})),i.createElement(O.a,null,i.createElement(M.a,{dialogActive:o,handleConfirm:this.handleUnlinkConfirm,handleDialog:this.handleDialog,title:Object(E.__)("Disconnect","google-site-kit"),subtitle:Object(E.__)("Disconnecting Site Kit by Google will remove your access to all services. After disconnecting, you will need to re-authorize to restore service.","google-site-kit"),confirmButton:Object(E.__)("Disconnect","google-site-kit"),provides:[],danger:!0}))):null}}]),UserMenu}(k.a);t.a=U((function(e){return{proxyPermissionsURL:e(D.c).getProxyPermissionsURL(),userEmail:e(w.d).getEmail(),userPicture:e(w.d).getPicture()}}))(x)}).call(this,n(17),n(3))},174:function(e,t,n){"use strict";(function(e){var i=n(7),r=n.n(i),a=n(8),o=n.n(a),l=n(9),c=n.n(l),u=n(10),s=n.n(u),d=n(4),m=n.n(d),p=n(1),f=n(2),g=n.n(f),h=n(43);function v(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,i=m()(e);if(t){var r=m()(this).constructor;n=Reflect.construct(i,arguments,r)}else n=i.apply(this,arguments);return s()(this,n)}}var y=function(t){c()(Menu,t);var n=v(Menu);function Menu(e){var t;return r()(this,Menu),(t=n.call(this,e)).menuRef=Object(p.i)(),t}return o()(Menu,[{key:"componentDidMount",value:function(){var e=this.props.menuOpen;this.menu=new h.f(this.menuRef.current),this.menu.open=e,this.menu.setDefaultFocusState(1)}},{key:"componentDidUpdate",value:function(e){var t=this.props.menuOpen;t!==e.menuOpen&&(this.menu.open=t)}},{key:"render",value:function(){var t=this.props,n=t.menuOpen,i=t.menuItems,r=t.onSelected,a=t.id;return e.createElement("div",{className:"mdc-menu mdc-menu-surface",ref:this.menuRef},e.createElement("ul",{id:a,className:"mdc-list",role:"menu","aria-hidden":!n,"aria-orientation":"vertical",tabIndex:"-1"},i.map((function(t,n){return e.createElement("li",{key:n,className:"mdc-list-item",role:"menuitem",onClick:r.bind(null,n),onKeyDown:r.bind(null,n)},e.createElement("span",{className:"mdc-list-item__text"},t))}))))}}]),Menu}(p.a);y.propTypes={menuOpen:g.a.bool.isRequired,menuItems:g.a.array.isRequired,id:g.a.string.isRequired},t.a=y}).call(this,n(3))},175:function(e,t,n){"use strict";var i=n(7),r=n.n(i),a=n(8),o=n.n(a),l=n(9),c=n.n(l),u=n(10),s=n.n(u),d=n(4),m=n.n(d),p=n(84);function f(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,i=m()(e);if(t){var r=m()(this).constructor;n=Reflect.construct(i,arguments,r)}else n=i.apply(this,arguments);return s()(this,n)}}var g=function(e){c()(ErrorNotification,e);var t=f(ErrorNotification);function ErrorNotification(){return r()(this,ErrorNotification),t.apply(this,arguments)}return o()(ErrorNotification,[{key:"render",value:function(){return null}}]),ErrorNotification}(n(1).a);t.a=Object(p.a)("googlesitekit.ErrorNotification")(g)},29:function(e,t,n){"use strict";n.d(t,"c",(function(){return i})),n.d(t,"a",(function(){return r})),n.d(t,"b",(function(){return a}));var i="core/site",r="primary",a="secondary"},325:function(e,t,n){"use strict";n.r(t),function(e,i){var r=n(7),a=n.n(r),o=n(8),l=n.n(o),c=n(9),u=n.n(c),s=n(10),d=n.n(s),m=n(4),p=n.n(m),f=n(1),g=n(13),h=n(84),v=n(0),y=n(94),_=n(26),k=n(93),E=n(5);function b(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,i=p()(e);if(t){var r=p()(this).constructor;n=Reflect.construct(i,arguments,r)}else n=i.apply(this,arguments);return d()(this,n)}}var R=function(t){u()(BaseComponent,t);var n=b(BaseComponent);function BaseComponent(){return a()(this,BaseComponent),n.apply(this,arguments)}return l()(BaseComponent,[{key:"render",value:function(){var t=this.props.children;return e.createElement(f.b,null,t)}}]),BaseComponent}(f.a),S=function(t){u()(SetupWrapper,t);var n=b(SetupWrapper);function SetupWrapper(e){var t;a()(this,SetupWrapper),t=n.call(this,e);var r=i._googlesitekitLegacyData.setup.moduleToSetup;return t.state={currentModule:r},t}return l()(SetupWrapper,[{key:"render",value:function(){var t=this.state.currentModule,n=SetupWrapper.loadSetupModule(t),i=Object(E.l)("googlesitekit-settings",{});return e.createElement(f.b,null,e.createElement(y.a,null),e.createElement("div",{className:"googlesitekit-setup"},e.createElement("div",{className:"mdc-layout-grid"},e.createElement("div",{className:"mdc-layout-grid__inner"},e.createElement("div",{className:" mdc-layout-grid__cell mdc-layout-grid__cell--span-12 "},e.createElement("section",{className:"googlesitekit-setup__wrapper"},e.createElement("div",{className:"mdc-layout-grid"},e.createElement("div",{className:"mdc-layout-grid__inner"},e.createElement("div",{className:" mdc-layout-grid__cell mdc-layout-grid__cell--span-12 "},e.createElement("p",{className:" googlesitekit-setup__intro-title googlesitekit-overline "},Object(v.__)("Connect Service","google-site-kit")),n))),e.createElement("div",{className:"googlesitekit-setup__footer"},e.createElement("div",{className:"mdc-layout-grid"},e.createElement("div",{className:"mdc-layout-grid__inner"},e.createElement("div",{className:" mdc-layout-grid__cell mdc-layout-grid__cell--span-2-phone mdc-layout-grid__cell--span-4-tablet mdc-layout-grid__cell--span-6-desktop "},e.createElement(_.a,{id:"setup-".concat(t,"-cancel"),href:i},Object(v.__)("Cancel","google-site-kit"))),e.createElement("div",{className:" mdc-layout-grid__cell mdc-layout-grid__cell--span-2-phone mdc-layout-grid__cell--span-4-tablet mdc-layout-grid__cell--span-6-desktop mdc-layout-grid__cell--align-right "},e.createElement(k.a,null)))))))))))}}],[{key:"loadSetupModule",value:function(t){var n=Object(h.a)("googlesitekit.ModuleSetup-".concat(t))(R);return e.createElement(n,{finishSetup:SetupWrapper.finishSetup,onSettingsPage:!1,isEditing:!0})}},{key:"finishSetup",value:function(e){if(!e){var t,n,r={notification:"authentication_success"};(null===(t=i._googlesitekitLegacyData)||void 0===t||null===(n=t.setup)||void 0===n?void 0:n.moduleToSetup)&&(r.slug=i._googlesitekitLegacyData.setup.moduleToSetup),e=Object(E.l)("googlesitekit-dashboard",r)}Object(g.delay)((function(){i.location.replace(e)}),500,"later")}}]),SetupWrapper}(f.a);t.default=S}.call(this,n(3),n(17))},93:function(e,t,n){"use strict";(function(e){n(1);var i=n(0),r=n(26);t.a=function HelpLink(){var t=Object(i.__)("Need help?","google-site-kit");return e.createElement(r.a,{className:"googlesitekit-help-link",href:"https://sitekit.withgoogle.com/documentation/",external:!0},t)}}).call(this,n(3))},94:function(e,t,n){"use strict";(function(e){var i=n(1),r=n(11),a=n.n(r),o=n(152),l=n(173),c=n(175),u=n(22),s=a.a.useSelect;t.a=function Header(){var t=s((function(e){return e(u.d).isAuthenticated()}));return e.createElement(i.b,null,e.createElement("header",{className:"googlesitekit-header"},e.createElement("section",{className:"mdc-layout-grid"},e.createElement("div",{className:"mdc-layout-grid__inner"},e.createElement("div",{className:" mdc-layout-grid__cell mdc-layout-grid__cell--align-middle mdc-layout-grid__cell--span-3-phone mdc-layout-grid__cell--span-4-tablet mdc-layout-grid__cell--span-6-desktop "},e.createElement(o.a,null)),e.createElement("div",{className:" mdc-layout-grid__cell mdc-layout-grid__cell--align-middle mdc-layout-grid__cell--align-right-phone mdc-layout-grid__cell--span-1-phone mdc-layout-grid__cell--span-4-tablet mdc-layout-grid__cell--span-6-desktop "},t&&e.createElement(l.a,null))))),e.createElement(c.a,null))}}).call(this,n(3))}}]);