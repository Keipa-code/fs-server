import React from 'react'
const Uppy = require('@uppy/core')
const Tus = require('@uppy/tus')
const { DashboardModal, useUppy } = require('@uppy/react')

function DropZone () {
    const uppy = useUppy(() => {
        return new Uppy()
            .use(Tus, { endpoint: 'https://tusd.tusdemo.net/files' })
    })

    return <DashboardModal uppy={uppy} />
}

export default DropZone