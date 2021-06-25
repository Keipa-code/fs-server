import React from 'react'
import '@uppy/core/dist/style.css'
import '@uppy/dashboard/dist/style.css'

const Uppy = require('@uppy/core')
const Tus = require('@uppy/tus')
const { DashboardModal } = require('@uppy/react')

class UppyComp extends React.Component {
    constructor (props) {
        super(props)
        this.uppy = Uppy()
          .use(Tus, { endpoint: 'https://tusd.tusdemo.net/files' })
    }

    componentWillUnmount () {
        this.uppy.close()
    }

    render () {
        return <DashboardModal uppy={this.uppy} />
    }
}

export default UppyComp