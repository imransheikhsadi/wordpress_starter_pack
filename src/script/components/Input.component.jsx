import React from 'react'
// import 'Input.style.scss'

export default function Input({handler}) {
    return (
        <>
          <input 
            className="search-term" 
            type="text" 
            placeholder="What are you looking for?" 
            id="search-trm"
            onChange={handler}
          />
        </>
    )
}
