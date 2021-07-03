/* eslint-disable */
import '@uppy/core/dist/style.css'
import '@uppy/dashboard/dist/style.css'
const React = require('react')
const Uppy = require('@uppy/core')
const Tus = require('@uppy/tus')
const Russian = require('@uppy/locales/lib/ru_RU')
const { Dashboard } = require('@uppy/react')

class Dropzone extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      showInlineDashboard: false,
      open: false,
    }

    this.uppy = new Uppy({
      id: 'uppy',
      autoProceed: true,
      debug: true,
      locale: Russian,
    }).use(Tus, { endpoint: '/api/upload/', limit: 10 })
    let test = this.uppy.getState()
    test.files
  }

  componentWillUnmount() {
    this.uppy.close()
  }

  render() {
    return (
      <Dashboard
        uppy={this.uppy}
        metaFields={[{ id: 'name', name: 'Name', placeholder: 'File name' }]}
        showLinkToFileUploadResult={false}
        proudlyDisplayPoweredByUppy={false}
        uploadComplete={() => console.log('work it')}
      />
    )
  }
}

export default Dropzone
