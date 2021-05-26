<template>
  <header class="box-header mdc-top-app-bar">
  <div class="fluid-head-bar">
    <section class="brand">
      <a>FS-server</a>
    </section>
    <section class="down-button">
      <a>FS-server</a>
    </section>
  </div>
  </header>
</template>
<style>

.box-header {
  box-shadow:0 2px 4px -1px rgba(0,0,0,.2),0 4px 5px 0 rgba(0,0,0,.14),0 1px 10px 0 rgba(0,0,0,.12);
  transition:box-shadow 200ms linear
}

.mdc-top-app-bar {
  background-color: #3097d1;
  color: #fff;
  display: flex;
  position: fixed;
  flex-direction: column;
  justify-content: space-between;
  box-sizing: border-box;
  width: 100%;
  z-index: 4;
}

header {
  flex: none;
  top: 0;
  left: 0;
}

.fluid-head-bar {
  display: flex;
  position: relative;
  box-sizing: border-box;
  width: 100%;
  height: 64px;
}

.brand {
  display: flex!important;
  align-items: center;
  flex-grow: 0;
  justify-content: flex-start;
  order: -1;
  min-width: 0;
  padding: 8px 12px;
  z-index: 1;
  margin-left: .5rem!important;
  margin-right: .5rem!important;
  box-sizing: border-box
}

h1 {
  margin-left: 20px;
}

body {
  font-size: 2rem;
  font-weight: 400;
  line-height: 1.5;
  text-align: left;
}
</style>