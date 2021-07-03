import React from 'react'
import './App.css'
import Home from './Home/Home'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import NotFound from './Error/NotFound'
import BrowseFiles from './BrowseFiles/BrowseFiles'

function App() {
  return (
    <BrowserRouter>
      <Switch>
        <Route exact path="/">
          <Home />
        </Route>
        <Route path="/search">
          <BrowseFiles />
        </Route>
        <Route path="*">
          <NotFound />
        </Route>
      </Switch>
    </BrowserRouter>
  )
}

export default App
